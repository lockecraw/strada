<?php
/**
 Admin Page Framework v3.5.7b01 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class FetchTweets_AdminPageFramework_Form_Model_Validation extends FetchTweets_AdminPageFramework_Form_Model_Validation_Opiton {
    protected function _handleSubmittedData() {
        if (!$this->_verifyFormSubmit()) {
            return;
        }
        $_aDefaultOptions = $this->oProp->getDefaultOptions($this->oForm->aFields);
        $_aOptions = $this->oUtil->addAndApplyFilter($this, "validation_saved_options_{$this->oProp->sClassName}", $this->oUtil->uniteArrays($this->oProp->aOptions, $_aDefaultOptions), $this);
        $_aInput = $this->oUtil->getElementAsArray($_POST, $this->oProp->sOptionKey, array());
        $_aInput = stripslashes_deep($_aInput);
        $_aInputRaw = $_aInput;
        $_sTabSlug = $this->oUtil->getElement($_POST, 'tab_slug', '');
        $_sPageSlug = $this->oUtil->getElement($_POST, 'page_slug', '');
        $_aInput = $this->oUtil->uniteArrays($_aInput, $this->oUtil->castArrayContents($_aInput, $this->_removePageElements($_aDefaultOptions, $_sPageSlug, $_sTabSlug)));
        $_aSubmit = $this->oUtil->getElementAsArray($_POST, '__submit', array());
        $_sSubmitSectionID = $this->_getPressedSubmitButtonData($_aSubmit, 'section_id');
        $_sPressedFieldID = $this->_getPressedSubmitButtonData($_aSubmit, 'field_id');
        $_sPressedInputID = $this->_getPressedSubmitButtonData($_aSubmit, 'input_id');
        $this->_doActions_submit($_aInput, $_aOptions, $_sPageSlug, $_sTabSlug, $_sSubmitSectionID, $_sPressedFieldID, $_sPressedInputID);
        $_aStatus = array('settings-updated' => true);
        $_aInput = $this->_validateSubmittedData($_aInput, $_aInputRaw, $_aOptions, $_aStatus);
        $_bUpdated = false;
        if (!$this->oProp->_bDisableSavingOptions) {
            $_bUpdated = $this->oProp->updateOption($_aInput);
        }
        $this->_doActions_submit_after($_aInput, $_aOptions, $_sPageSlug, $_sTabSlug, $_sSubmitSectionID, $_sPressedFieldID, $_bUpdated);
        exit(wp_redirect($this->_getSettingUpdateURL($_aStatus, $_sPageSlug, $_sTabSlug)));
    }
    private function _doActions_submit($_aInput, $_aOptions, $_sPageSlug, $_sTabSlug, $_sSubmitSectionID, $_sPressedFieldID, $_sPressedInputID) {
        if (has_action("submit_{$this->oProp->sClassName}_{$_sPressedInputID}")) {
            trigger_error('Admin Page Framework: ' . ' : ' . sprintf(__('The hook <code>%1$s</code>is deprecated. Use <code>%2$s</code> instead.', $this->oProp->sTextDomain), "submit_{instantiated class name}_{pressed input id}", "submit_{instantiated class name}_{pressed field id}"), E_USER_WARNING);
        }
        $this->oUtil->addAndDoActions($this, array("submit_{$this->oProp->sClassName}_{$_sPressedInputID}", $_sSubmitSectionID ? "submit_{$this->oProp->sClassName}_{$_sSubmitSectionID}_{$_sPressedFieldID}" : "submit_{$this->oProp->sClassName}_{$_sPressedFieldID}", $_sSubmitSectionID ? "submit_{$this->oProp->sClassName}_{$_sSubmitSectionID}" : null, isset($_POST['tab_slug']) ? "submit_{$this->oProp->sClassName}_{$_sPageSlug}_{$_sTabSlug}" : null, "submit_{$this->oProp->sClassName}_{$_sPageSlug}", "submit_{$this->oProp->sClassName}",), $_aInput, $_aOptions, $this);
    }
    private function _doActions_submit_after($_aInput, $_aOptions, $_sPageSlug, $_sTabSlug, $_sSubmitSectionID, $_sPressedFieldID, $_bUpdated) {
        $this->oUtil->addAndDoActions($this, array($this->oUtil->getAOrB($_sSubmitSectionID, "submit_after_{$this->oProp->sClassName}_{$_sSubmitSectionID}_{$_sPressedFieldID}", "submit_after_{$this->oProp->sClassName}_{$_sPressedFieldID}"), $this->oUtil->getAOrB($_sSubmitSectionID, "submit_after_{$this->oProp->sClassName}_{$_sSubmitSectionID}", null), $this->oUtil->getAOrB(isset($_POST['tab_slug']), "submit_after_{$this->oProp->sClassName}_{$_sPageSlug}_{$_sTabSlug}", null), "submit_after_{$this->oProp->sClassName}_{$_sPageSlug}", "submit_after_{$this->oProp->sClassName}",), $_bUpdated ? $_aInput : array(), $_aOptions, $this);
    }
    private function _getSettingUpdateURL(array $aStatus, $sPageSlug, $sTabSlug) {
        $aStatus = $this->oUtil->addAndApplyFilters($this, array("options_update_status_{$sPageSlug}_{$sTabSlug}", "options_update_status_{$sPageSlug}", "options_update_status_{$this->oProp->sClassName}",), $aStatus);
        $_aRemoveQueries = array();
        if (!isset($aStatus['field_errors']) || !$aStatus['field_errors']) {
            unset($aStatus['field_errors']);
            $_aRemoveQueries[] = 'field_errors';
        }
        return $this->oUtil->addAndApplyFilters($this, array("setting_update_url_{$this->oProp->sClassName}",), $this->oUtil->getQueryURL($aStatus, $_aRemoveQueries, $_SERVER['REQUEST_URI']));
    }
    private function _verifyFormSubmit() {
        if (!isset($_POST['_is_admin_page_framework'], $_POST['page_slug'], $_POST['tab_slug'], $_POST['_wp_http_referer'])) {
            return false;
        }
        $_sRequestURI = remove_query_arg(array('settings-updated', 'confirmation', 'field_errors'), wp_unslash($_SERVER['REQUEST_URI']));
        $_sReffererURI = remove_query_arg(array('settings-updated', 'confirmation', 'field_errors'), $_POST['_wp_http_referer']);
        if ($_sRequestURI != $_sReffererURI) {
            return false;
        }
        $_sNonceTransientKey = 'form_' . md5($this->oProp->sClassName . get_current_user_id());
        if ($_POST['_is_admin_page_framework'] !== $this->oUtil->getTransient($_sNonceTransientKey)) {
            $this->setAdminNotice($this->oMsg->get('nonce_verification_failed'));
            return false;
        }
        return true;
    }
    protected function _validateSubmittedData($aInput, $aInputRaw, $aOptions, &$aStatus) {
        $_sTabSlug = $this->oUtil->getElement($_POST, 'tab_slug', '');
        $_sPageSlug = $this->oUtil->getElement($_POST, 'page_slug', '');
        $_aSubmit = $this->oUtil->getElementAsArray($_POST, '__submit', array());
        $_sPressedInputName = $this->_getPressedSubmitButtonData($_aSubmit, 'name');
        $_sSubmitSectionID = $this->_getPressedSubmitButtonData($_aSubmit, 'section_id');
        $_aSubmitInformation = array('page_slug' => $_sPageSlug, 'tab_slug' => $_sTabSlug, 'input_id' => $this->_getPressedSubmitButtonData($_aSubmit, 'input_id'), 'section_id' => $_sSubmitSectionID, 'field_id' => $this->_getPressedSubmitButtonData($_aSubmit, 'field_id'),);
        try {
            $this->_doContactForm($aInputRaw, $_aSubmit, $_sPressedInputName, $_sSubmitSectionID);
            $this->_confirmReset($aStatus, $_aSubmit, $_sPressedInputName, $_sSubmitSectionID);
            $this->_goToLink($_aSubmit);
            $this->_setRedirect($aStatus, $_aSubmit, $_sPageSlug);
            $aInput = $this->_getFilteredOptions($aInput, $aInputRaw, $aOptions, $_aSubmitInformation, $aStatus);
            $this->_doImportOptions($_sPageSlug, $_sTabSlug);
            $this->_doExportOptions($_sPageSlug, $_sTabSlug);
            $this->_doResetOptions($_aSubmit, $aInput);
            $this->_confirmContactForm($aStatus, $_aSubmit, $aInput, $_sPressedInputName, $_sSubmitSectionID);
        }
        catch(Exception $_oException) {
            $_sPropertyName = $_oException->getMessage();
            if (isset($_oException->$_sPropertyName)) {
                return $_oException->{$_sPropertyName};
            }
            return array();
        }
        $this->_setSettingNoticeAfterValidation(empty($aInput));
        return $aInput;
    }
    private function _doContactForm($aInputRaw, array $_aSubmit, $_sPressedInputName, $_sSubmitSectionID) {
        $_bConfirmedToSendEmail = ( bool )$this->_getPressedSubmitButtonData($_aSubmit, 'confirmed_sending_email');
        if (!$_bConfirmedToSendEmail) {
            return;
        }
        $this->_sendEmailInBackground($aInputRaw, $_sPressedInputName, $_sSubmitSectionID);
        $this->oProp->_bDisableSavingOptions = true;
        $this->oUtil->deleteTransient('apf_tfd' . md5('temporary_form_data_' . $this->oProp->sClassName . get_current_user_id()));
        add_action("setting_update_url_{$this->oProp->sClassName}", array($this, '_replyToRemoveConfirmationQueryKey'));
        $_oException = new Exception('aReturn');
        $_oException->aReturn = $aInputRaw;
        throw $_oException;
    }
    private function _sendEmailInBackground($aInput, $sPressedInputNameFlat, $sSubmitSectionID) {
        $_sTranskentKey = 'apf_em_' . md5($sPressedInputNameFlat . get_current_user_id());
        $_aEmailOptions = $this->oUtil->getTransient($_sTranskentKey);
        $this->oUtil->deleteTransient($_sTranskentKey);
        $_aEmailOptions = $this->oUtil->getAsArray($_aEmailOptions) + array('to' => '', 'subject' => '', 'message' => '', 'headers' => '', 'attachments' => '', 'is_html' => false, 'from' => '', 'name' => '',);
        $_sTransientKey = 'apf_emd_' . md5($sPressedInputNameFlat . get_current_user_id());
        $_aFormEmailData = array('email_options' => $_aEmailOptions, 'input' => $aInput, 'section_id' => $sSubmitSectionID,);
        $_bIsSet = $this->oUtil->setTransient($_sTransientKey, $_aFormEmailData, 100);
        wp_remote_get(add_query_arg(array('apf_action' => 'email', 'transient' => $_sTransientKey,), admin_url($GLOBALS['pagenow'])), array('timeout' => 0.01, 'sslverify' => false,));
        $_bSent = $_bIsSet;
        $this->setSettingNotice($this->oMsg->get($this->oUtil->getAOrB($_bSent, 'email_scheduled', 'email_could_not_send')), $this->oUtil->getAOrB($_bSent, 'updated', 'error'));
    }
    private function _confirmReset(array & $aStatus, array $_aSubmit, $_sPressedInputName, $_sSubmitSectionID) {
        $_bIsReset = ( bool )$this->_getPressedSubmitButtonData($_aSubmit, 'is_reset');
        if (!$_bIsReset) {
            return;
        }
        $aStatus = $aStatus + array('confirmation' => 'reset');
        $_oException = new Exception('aReturn');
        $_oException->aReturn = $this->_confirmSubmitButtonAction($_sPressedInputName, $_sSubmitSectionID, 'reset');
        throw $_oException;
    }
    private function _goToLink(array $_aSubmit) {
        $_sLinkURL = $this->_getPressedSubmitButtonData($_aSubmit, 'href');
        if (!$_sLinkURL) {
            return;
        }
        exit(wp_redirect($_sLinkURL));
    }
    private function _setRedirect(array & $aStatus, $_aSubmit, $_sPageSlug) {
        $_sRedirectURL = $this->_getPressedSubmitButtonData($_aSubmit, 'redirect_url');
        if (!$_sRedirectURL) {
            return;
        }
        $aStatus = $aStatus + array('confirmation' => 'redirect');
        $this->_setRedirectTransients($_sRedirectURL, $_sPageSlug);
    }
    private function _doImportOptions($_sPageSlug, $_sTabSlug) {
        if ($this->hasFieldError()) {
            return;
        }
        if (!isset($_POST['__import']['submit'], $_FILES['__import'])) {
            return;
        }
        $_oException = new Exception('aReturn');
        $_oException->aReturn = $this->_importOptions($this->oProp->aOptions, $_sPageSlug, $_sTabSlug);
        throw $_oException;
    }
    private function _doExportOptions($_sPageSlug, $_sTabSlug) {
        if ($this->hasFieldError()) {
            return;
        }
        if (!isset($_POST['__export']['submit'])) {
            return;
        }
        exit($this->_exportOptions($this->oProp->aOptions, $_sPageSlug, $_sTabSlug));
    }
    private function _doResetOptions(array $_aSubmit, array $aInput) {
        $_sKeyToReset = $this->_getPressedSubmitButtonData($_aSubmit, 'reset_key');
        $_sKeyToReset = trim($_sKeyToReset);
        if (!$_sKeyToReset) {
            return;
        }
        $_oException = new Exception('aReturn');
        $_oException->aReturn = $this->_resetOptions($_sKeyToReset, $aInput);
        throw $_oException;
    }
    private function _resetOptions($sKeyToReset, array $aInput) {
        if (!$this->oProp->sOptionKey) {
            return array();
        }
        if (in_array($sKeyToReset, array('1',), true)) {
            delete_option($this->oProp->sOptionKey);
            return array();
        }
        $_aDimensionalKeys = explode('|', $sKeyToReset);
        $this->oUtil->unsetDimensionalArrayElement($this->oProp->aOptions, $_aDimensionalKeys);
        $this->oUtil->unsetDimensionalArrayElement($aInput, $_aDimensionalKeys);
        update_option($this->oProp->sOptionKey, $this->oProp->aOptions);
        $this->setSettingNotice($this->oMsg->get('specified_option_been_deleted'));
        return $aInput;
    }
    private function _confirmContactForm(array & $aStatus, array $_aSubmit, array $aInput, $_sPressedInputName, $_sSubmitSectionID) {
        if ($this->hasFieldError()) {
            return;
        }
        $_bConfirmingToSendEmail = ( bool )$this->_getPressedSubmitButtonData($_aSubmit, 'confirming_sending_email');
        if (!$_bConfirmingToSendEmail) {
            return;
        }
        $this->_setLastInput($aInput);
        $this->oProp->_bDisableSavingOptions = true;
        $aStatus = $aStatus + array('confirmation' => 'email');
        $_oException = new Exception('aReturn');
        $_oException->aReturn = $this->_confirmSubmitButtonAction($_sPressedInputName, $_sSubmitSectionID, 'email');
        throw $_oException;
    }
    public function _replyToRemoveConfirmationQueryKey($sSettingUpdateURL) {
        return remove_query_arg(array('confirmation',), $sSettingUpdateURL);
    }
    private function _confirmSubmitButtonAction($sPressedInputName, $sSectionID, $sType = 'reset') {
        switch ($sType) {
            default:
            case 'reset':
                $_sFieldErrorMessage = $this->oMsg->get('reset_options');
                $_sTransientKey = 'apf_rc_' . md5($sPressedInputName . get_current_user_id());
            break;
            case 'email':
                $_sFieldErrorMessage = $this->oMsg->get('send_email');
                $_sTransientKey = 'apf_ec_' . md5($sPressedInputName . get_current_user_id());
            break;
        }
        $_aNameKeys = explode('|', $sPressedInputName);
        $_sFieldID = $this->oUtil->getAOrB($sSectionID, $_aNameKeys[2], $_aNameKeys[1]);
        $_aErrors = array();
        if ($sSectionID) {
            $_aErrors[$sSectionID][$_sFieldID] = $_sFieldErrorMessage;
        } else {
            $_aErrors[$_sFieldID] = $_sFieldErrorMessage;
        }
        $this->setFieldErrors($_aErrors);
        $this->oUtil->setTransient($_sTransientKey, $sPressedInputName, 60 * 2);
        $this->setSettingNotice($this->oMsg->get('confirm_perform_task'), 'error confirmation');
        return $this->oProp->aOptions;
    }
    private function _setRedirectTransients($sURL, $sPageSlug) {
        if (empty($sURL)) {
            return;
        }
        $_sTransient = 'apf_rurl' . md5(trim("redirect_{$this->oProp->sClassName}_{$sPageSlug}"));
        return $this->oUtil->setTransient($_sTransient, $sURL, 60 * 2);
    }
    private function _getPressedSubmitButtonData(array $aPostElements, $sTargetKey = 'field_id') {
        foreach ($aPostElements as $_sInputID => $_aSubElements) {
            if (!isset($_aSubElements['name'])) {
                continue;
            }
            $_aNameKeys = explode('|', $_aSubElements['name']);
            if (null === $this->oUtil->getElement($_POST, $_aNameKeys, null)) {
                continue;
            }
            return $this->oUtil->getElement($_aSubElements, $sTargetKey, null);
        }
        return null;
    }
    private function _removePageElements($aOptions, $sPageSlug, $sTabSlug) {
        if (!$sPageSlug && !$sTabSlug) {
            return $aOptions;
        }
        if ($sTabSlug && $sPageSlug) {
            return $this->oForm->getOtherTabOptions($aOptions, $sPageSlug, $sTabSlug);
        }
        return $this->oForm->getOtherPageOptions($aOptions, $sPageSlug);
    }
}