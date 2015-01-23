<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule\Model;

/**
 * For manager, and non-record input module (HtmlInput, Redirect, Dynamic Page, Sitemap, Sub-section Index, etc)<br />
 * it stores db functions related to: history, content, workflow, etc.
 *
 * @version $id$
 * @author peter.ho
 */
abstract class DataProvider
{

    /**
     * Get Content from the module table
     */
    abstract public static function getContent($contentId, $charsetId);

    /**
     * Update Content of the module table
     */
    abstract public static function updateContent($contentId, $charsetId);

    /**
     * Get Content from the module table
     */
    abstract public static function isContentExists($contentId, $charsetId);

    /**
     * Delete Content from the module table
     */
    abstract public static function deleteContent($contentId, $charsetId);

    /**
     * Delete All Content from the module table
     */
    abstract public static function deleteAllContent($contentId, $charsetId);

}
