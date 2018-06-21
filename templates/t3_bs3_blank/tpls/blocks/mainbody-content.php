<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

if (is_array($this->getParam('skip_component_content')) &&
        in_array(JFactory::getApplication()->input->getInt('Itemid'), $this->getParam('skip_component_content')))
    return;
?>

<?php
// positions configuration
if ($this->countModules('main-content')) :
    ?>


    <div class="container">
        <jdoc:include type="modules" name="main-content" />
    </div>
    <?php
 
endif 
?>