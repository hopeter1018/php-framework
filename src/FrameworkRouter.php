<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

use Hopeter1018\Helper\ReflectedClass;
use Hopeter1018\Framework\ManagerModule\ModuleController;
use Hopeter1018\Framework\ManagerModule\ModuleConfigure;
use Hopeter1018\Framework\Exceptions\FrameworkRouterException;
use Hopeter1018\Framework\Returnable\Returnable;
use Hopeter1018\DoctrineExtension\AnnotationHelper;
use Hopeter1018\Framework\UserAccessControl\UserAccessControl;
use Hopeter1018\TwigExtension\TwigGetter;

/**
 * Description of FrameworkRouter
 *
 * @version $id$
 * @author peter.ho
 */
final class FrameworkRouter
{

// <editor-fold defaultstate="collapsed" desc="Constant and properties">

    const GET_NAMESPACE = 'm';
    const GET_CONTROLLER = 's';
    const GET_METHOD = 'a';

    /**
     *
     * @var ReflectedClass[] 
     */
    private static $moduleConfigs = array ();

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Request parser">

    /**
     * Only throws exceptions in UAT mode
     * 
     * @throws FrameworkRouterException
     * @param string|null $namespace
     */
    private static function debugRequestNamespace($namespace)
    {
        if ($namespace === null and APP_IS_UAT) {
            if (!isset($_GET[static::GET_NAMESPACE])) {
                throw new FrameworkRouterException("No parameter " . static::GET_NAMESPACE . " passed.");
            } elseif (!array_keys(static::$moduleConfigs, $_GET[static::GET_NAMESPACE])) {
                throw new FrameworkRouterException("Parameter " . static::GET_NAMESPACE . " not registered.");
            } elseif (count(static::$moduleConfigs) === 0) {
                throw new FrameworkRouterException("No module registered.");
            }
        }
    }

    /**
     * Get the target module from $_GET[ namespace ]<br />
     * <ul>
     * <li>if $_GET[ namespace ] exists and exists in the registered pool<br /><b>return</b> $_GET[ namespace ]* </li>
     * <li>if $_GET[ namespace ] not exists and only 1 module registered<br /><b>return</b> the ONLY registered</li>
     * </ul>
     * 
     * @return string The key of the module in registered pool
     */
    private static function getRequestNamespace()
    {
        $namespace = null;
        if (isset($_GET[static::GET_NAMESPACE]) and array_keys(static::$moduleConfigs, $_GET[static::GET_NAMESPACE])) {
            $namespace = $_GET[static::GET_NAMESPACE];
        } elseif (count(static::$moduleConfigs) === 1) {
            $keys = array_keys(static::$moduleConfigs);
            $namespace = $keys[0];
        }
        static::debugRequestNamespace($namespace);
        return $namespace;
    }

    /**
     * Only throws exceptions in UAT mode
     * 
     * @param type $namespacedCtrlName
     * @throws FrameworkRouterException
     */
    private static function debugRequestCOntrollerName($namespacedCtrlName)
    {
        if ($namespacedCtrlName === null and APP_IS_UAT) {
            if (!isset($_GET[static::GET_CONTROLLER])) {
                throw new FrameworkRouterException("No parameter " . static::GET_CONTROLLER . " passed.");
            } elseif ($namespacedCtrlName !== '') {
                throw new FrameworkRouterException("Parameter " . static::GET_CONTROLLER . " not registered.");
            }
        }
    }

    /**
     * Get the target module from $_GET['s']<br />
     * <ul>
     * <li>if $_GET['s'] exists and exists in the module<br /><b>return</b> $_GET['s']* </li>
     * <li>if $_GET['s'] not exists throws exception</li>
     * </ul>
     * 
     * @throws 
     * @param string $namespace The requested namespace
     * @return ModuleController The key of the sub in module
     */
    private static function getRequestController($namespace)
    {
        $ctrl = null;
        $namespacedCtrlName = null;
        if (isset($_GET[static::GET_CONTROLLER])) {
            $ctrlName = \Hopeter1018\Helper\NamingConvention::urlPartsToController($_GET[static::GET_CONTROLLER]);
            $config = static::$moduleConfigs[$namespace];
            $namespacedCtrlName = $config->refl->getNamespaceName() . "\\" . $ctrlName;
            $ctrl = (class_exists($namespacedCtrlName)) ? $namespacedCtrlName : null;
        }
        static::debugRequestCOntrollerName($namespacedCtrlName);
        return $ctrl;
    }

    /**
     * Only throws exceptions in UAT mode
     * 
     * @param type $namespacedCtrlName
     * @throws FrameworkRouterException
     */
    private static function debugRequestMethod()
    {
        if (APP_IS_UAT) {
            if (!isset($_GET[static::GET_METHOD])) {
                throw new FrameworkRouterException("No parameter " . static::GET_METHOD . " passed.");
            }
        }
    }

    /**
     * 
     * @param ModuleController|null $ctrl
     */
    private static function getRequestMethod()
    {
        static::debugRequestMethod();
        return (isset($_GET[static::GET_METHOD])) ? \Hopeter1018\Helper\NamingConvention::urlPartsToMethod($_GET[static::GET_METHOD]) : null;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Method Invoke">

    /**
     * Build the array of arguments to be invoked by the method reflection.
     * 
     * @param \stdClass $request
     * @param \ReflectionMethod $method
     * @return type
     * @throws FrameworkRouterException
     */
    private static function getMethodInvokeArgs($request, $method)
    {
        $invokeArgs = array ();
        $methodParam = $method->getParameters();
        foreach ($methodParam as $param) {
            /* @var $param \ReflectionParameter */
            if (isset($request->data) and isset($request->data->{$param->getName()})) {
                $invokeArgs[] = $request->data->{$param->getName()};
            } elseif (!$param->isOptional()) {
                throw new FrameworkRouterException("Invalid request: " . (APP_IS_DEV ? var_export($methodParam, true) : ""));
            }
        }
        return $invokeArgs;
    }

    /**
     * Call the controller method with appropriate request parameter(s)<br />
     * request parameter(s) were "guessed" with reflection<br />
     * 
     * @todo user-access-control 2 level: Method > Configure (default)
     * @param ModuleController $controllerName
     * @param string $methodName
     * @return mixed
     */
    private static function callControllerMethod($controllerName, $methodName)
    {
        $refl = new \ReflectionClass($controllerName);
        $method = $refl->getMethod($methodName);
        if ($method->isStatic()) {
            $request = \Hopeter1018\AngularjsExtension\WebRequest::getRequestParams();
            $invokeArgs = static::getMethodInvokeArgs($request, $method);
            return $method->invokeArgs(null, $invokeArgs);
        }
    }

    /**
     * Print out the method returned depends on different format/type
     * @param Returnable|mixed|boolean|array $methodReturn
     */
    private static function printMethodReturn($methodReturn)
    {
        if ($methodReturn instanceof Returnable) {
            echo $methodReturn->getReturn();
        } elseif (is_array($methodReturn)) {
            echo json_encode($methodReturn);
        } elseif (is_bool($methodReturn) or is_numeric($methodReturn) or is_string($methodReturn)
        ) {
            echo $methodReturn;
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Register and start">

    /**
     * Register module by moduleName
     * 
     * @param ModuleConfigure $config
     * @param type $moduleName
     */
    public static function register(ModuleConfigure $config, $moduleName = null)
    {
        if ($moduleName === null) {
            $moduleName = $config->getDefaultModuleName();
        }
        static::$moduleConfigs[$moduleName] = ReflectedClass::get($config);
    }

    /**
     * Start the application
     * map $_GET namespace, controller, method 
     * <ul>
     * <li><b>m</b> => module
     * <li><b>s</b> => sub
     * <li><b>a</b> => action
     * </ul>
     * 
     * @todo a cached m+s+a mechanism to speed up invoke process.
     * @todo log error
     * @todo what to return if exception, uac not allowed, etc.
     */
    public static function start()
    {
        $returned = false;
        try {
            $namespace = static::getRequestNamespace();
            $controller = static::getRequestController($namespace);

            $uacCtrl = AnnotationHelper::classAnnoExtends($controller, UserAccessControl::CLASSNAME);
            /* @var $uacCtrl UserAccessControl */
            if ($uacCtrl == null or $uacCtrl->isAllowed()) {
                $method = static::getRequestMethod();
                $uacMethod = AnnotationHelper::methodAnnoExtends($controller, $method, UserAccessControl::CLASSNAME);
                /* @var $uacMethod UserAccessControl */
                if ($uacMethod == null or $uacMethod->isAllowed()) {
                    $methodReturn = static::callControllerMethod($controller, $method);
                    static::printMethodReturn($methodReturn);
                    $returned = true;
                }
            }
        } catch (\Exception $ex) {
            \Hopeter1018\Helper\HttpResponse::addMessage($ex->getMessage());
        }

        if ($returned === false) {
            $config = reset(static::$moduleConfigs);    /* @var $config ReflectedClass */
            $defaultTwig = $config->obj->getDefaultTwig();

            echo TwigGetter::getTemplate($defaultTwig)
                ->render(array(
                    "_dir_" => dirname($defaultTwig) . "/",
                    "_file_" => $defaultTwig,
                    "_dir_relative_" => \Hopeter1018\FileOperation\Path::relativeTo(dirname($defaultTwig), SystemPath::workbenchPath()) . '/',
                ));
        }
    }

    /**
     * Shortcut to register + start useful to those single module PHP<br />
     * 
     * @see FrameworkRouter::register
     * @see FrameworkRouter::start
     * @param ModuleConfigure $config
     * @param type $moduleName
     */
    public static function startModule(ModuleConfigure $config, $moduleName = null)
    {
        static::register($config, $moduleName);
        static::start();
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Todo">

    /**
     * Reflect all controller in the namespace to build up the routes
     * 
     * @todo build up a mapping php for the Module to enhance the "start" method
     * @param \Hopeter1018\Framework\ModuleConfigure $config
     */
    public static function buildRoutes(ModuleConfigure $config)
    {
        
    }

// </editor-fold>

}
