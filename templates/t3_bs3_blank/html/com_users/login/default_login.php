<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>



<div class="container">
    <div class="row LoginDiv">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <?php if ($this->params->get('login_image') != '') : ?>
                    <div class="panel-heading">
                        <img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image img-responsive" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT'); ?>" />
                    <?php endif; ?>
                    <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->params->get('show_page_heading')) : ?>
                    <div class="page-header">
                        <h1>
                            <?php echo $this->escape($this->params->get('page_heading')); ?>
                        </h1>
                    </div>
                <?php endif; ?>



                <div class="panel-body">
                    <form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" class="" method="post">
                        <div class="userdata">

                            <fieldset>
                                <div class="form-group">
                                <div id="form-login-username" class="">

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="icon-user hasTooltip" title="" data-original-title="Username"></span>
                                            <label for="modlgn-username" class="element-invisible">Username</label>
                                        </span>
                                        <input type="text" name="username" id="username" value="" placeholder="Username" class="validate-username required form-control" size="35" required="" aria-required="true" autofocus="">
                                    </div>
                                </div>
                                    </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="icon-lock hasTooltip" title="" data-original-title="Password">
                                        </span>
                                        <label for="modlgn-passwd" class="element-invisible">Password							</label>
                                    </span>
                                    <input type="password" name="password" id="password" placeholder="Password"  value="" class="validate-password required form-control" size="35" maxlength="99" required="" aria-required="true">
                                </div>
                                <?php if ($this->tfa) : ?>
                                    <div class="control-group">
                                        <div class="control-label">
                                            <?php echo $this->form->getField('secretkey')->label; ?>
                                        </div>
                                        <div class="controls">
                                            <?php echo $this->form->getField('secretkey')->input; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me"  value="yes" />    <?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME'); ?>
                                        </label>
                                    </div>
                                <?php endif; ?>



                                <button type="submit" class="btn btn-primary btn-lg btn-block loginButton">
                                    <?php echo JText::_('JLOGIN'); ?>
                                </button>
                                <?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem'))); ?>
                                <input type="hidden" name="return" value="<?php echo base64_encode($return); ?>" />
                                <?php echo JHtml::_('form.token'); ?>


                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>