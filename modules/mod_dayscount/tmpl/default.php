<?php
/**
 * @copyright	Copyright (c) 2018 costom. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die;
$dayscont_array = moddayscountHelper::getcurentdaycount();
?>
<p class="daycount"><?php echo  $dayscont_array['totaldays']." Total Days | ". $dayscont_array['humanreadable']; ?></p>