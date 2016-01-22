<?php
/**
 * DokuWiki Plugin nosecedit (Action Component) 
 * 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps
 */

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'action.php';
//require_once DOKU_PLUGIN.'edittable/common.php';

class action_plugin_nosecedit extends DokuWiki_Action_Plugin
	{
	var $helper = FALSE;
	
	/**
	 * set a databuffer :-)	
	 */
	function action_plugin_nosecedit()
		{	
		}
	
    /**
     * Register its handlers with the DokuWiki's event controller
     */
    function register(Doku_Event_Handler $controller)
    	{
        $controller->register_hook('HTML_SECEDIT_BUTTON', 'BEFORE', $this, 'html_secedit_button');
    	}

    function html_secedit_button(&$event)
    	{
	    global $ID;
	    
	    //Section event?
        if ($event->data['target'] !== 'section')
        	{
            return;
        	}

        //disable requested?
        if (p_get_metadata($ID,"sectionedit",FALSE) == "off")
        	{
	        $event->data['name'] = "";
        	}
    	}
	}
