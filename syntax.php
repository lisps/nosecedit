<?php
/**
 * DokuWiki Plugin nosecedit (Syntax Component) 
 * 
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  lisps
 */

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

/*
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_nosecedit extends DokuWiki_Syntax_Plugin
	{
		
    /*
     * enable sectionedit by default
     */
	function syntax_plugin_nosecedit()
		{
		global $ID;
		
		if ($ID != "")
			{
			p_set_metadata($ID,array("sectionedit"=>"on"),FALSE,TRUE);
			}
		}

    /*
     * What kind of syntax are we?
     */
    function getType()
    	{
        return 'substition';
    	}

    /*
     * Where to sort in?
     */
    function getSort()
    	{
        return 155;
    	}

    /*
     * Paragraph Type
     */
    function getPType()
    	{
        return 'normal';
    	}

    /*
     * Connect pattern to lexer
     */
    function connectTo($mode)
    	{
        $this->Lexer->addSpecialPattern("~~NOSECTIONEDIT~~",$mode,'plugin_nosecedit');
    	}


    /*
     * Handle the matches
     */
    function handle($match, $state, $pos, &$handler)
    	{
      	global $ID;
        return (array($ID=>TRUE));        
    	}
    
    /*
     * Create output
     */
    function render($mode, &$renderer, $opt)
    	{
	    global $ID;

	    //save flags to metadata	    
		//if($mode == 'metadata')
			{
	    	if (isset($opt[$ID])==TRUE)
		    	{
				p_set_metadata($ID,array("sectionedit"=>"off"),FALSE,TRUE);
	    		}
	    	else
	    		{
				p_set_metadata($ID,array("sectionedit"=>"on"),FALSE,TRUE);
	    		}
    		}
	    return (TRUE);
        }
	}
//Setup VIM: ex: et ts=4 enc=utf-8 :
