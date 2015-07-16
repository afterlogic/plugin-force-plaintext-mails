<?php

/* -AFTERLOGIC LICENSE HEADER- */

class_exists('CApi') or die();

class CForcePlaintextMailsPlugin extends AApiPlugin
{
	/**
	 * @param CApiPluginManager $oPluginManager
	 */
	public function __construct(CApiPluginManager $oPluginManager)
	{
		parent::__construct('1.0', $oPluginManager);
	}

	public function Init()
	{
		parent::Init();

		$this->AddHook('webmail.message-text-html-raw', 'WebmailMessageTextHtmlRaw');
	}
	
	public function WebmailMessageTextHtmlRaw($oAccount, &$oMessage, &$sText, &$bTextIsHtml)
	{
		if ($bTextIsHtml)
		{
			$sText = \MailSo\Base\HtmlUtils::ConvertHtmlToPlain($sText);
			$bTextIsHtml = false;
		}
	}
}

return new CForcePlaintextMailsPlugin($this);

