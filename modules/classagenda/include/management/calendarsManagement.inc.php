<?php
/**
 * Calendars Management Class
 *
 * @package			classagenda module
 * @author			Giorgio Consorti <g.consorti@lynxlab.com>
 * @copyright		Copyright (c) 2014, Lynx s.r.l.
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU Public License v.2
 * @link			classagenda
 * @version			0.1
 */

/**
 * class for managing Calendars
 *
 * @author giorgio
 */
require_once MODULES_CLASSAGENDA_PATH . '/include/management/abstractClassagendaManagement.inc.php';

class calendarsManagement extends abstractClassAgendaManagement
{
	public $id_calendar;
	public $id_course_instance;
	public $id_classagenda;
	public $start_timestamp;
	public $break_start_timestamp;
	public $break_end_timestamp;
	public $end_timestamp; 
    
	/**
	 * build, manage and display the module's pages
	 *
	 * @return array
	 * 
	 * @access public
	 */
	public function run($action=null) {
		
		require_once ROOT_DIR . '/include/HtmlLibrary/BaseHtmlLib.inc.php';
		
		/* @var $html	string holds html code to be retuned */
		$htmlObj = null;
		/* @var $path	string  path var to render in the help message */
		$help = translateFN('Da qui puoi inserire o modifcare il calendario delle lezioni di una classe');
		/* @var $status	string status var to render in the breadcrumbs */
		$title= translateFN('Calendario');
		
		switch ($action) {
			case MODULES_CLASSAGENDA_EDIT_CAL:
				/**
				 * edit action, build needed HTML objects
				 */
				$htmlObj = CDOMElement::create('div','id:calendarContainer');
				$calendarDIV = CDOMElement::create('div','id:classcalendar');
				
				$saveButton = CDOMElement::create('input_button','id:saveCalendar');
				$saveButton->setAttribute('value', translateFN('Salva'));
				
				/**
				 * get courses instances list, build select item
				 * and a span to hold number of subscribed students
				 */
				$instances = $this->_getInstances();
				if (count($instances)>0) {
					foreach ($instances as $instance) {
						$dataAr[$instance['id']] = $instance['title'];
					}
					reset($dataAr);
					
					$instancesSELECT = BaseHtmlLib::selectElement2('id:instancesList,name:instancesList',$dataAr,key($dataAr));
					unset($dataAr);
					
					$instancesLABEL = CDOMElement::create('label','for:instancesList');
					$instancesLABEL->addChild(new CText(translateFN('Seleziona una classe').': '));
					
					$studentCountSPAN = CDOMElement::create('span','class:studentcount');
					$studentCountSPAN->addChild (new CText(translateFN('Numero di studenti iscritti: ')));
					$studentCountSPAN->addChild (CDOMElement::create('span','id:studentcount'));
					
					$selectClassDIV = CDOMElement::create('div','id:selectClassContainer');
					$selectClassDIV->addChild($instancesLABEL);
					$selectClassDIV->addChild($instancesSELECT);
					$selectClassDIV->addChild($studentCountSPAN);
				}
				
				/**
				 * get Venues, build select item
				 * and needed empty div to hold classroom list for selected venue
				 */
				$venues = $this->_getVenues();
				if (!is_null($venues)) {
					$classroomsDIV = CDOMElement::create('div','id:classrooms');
					
					foreach ($venues as $venue) {
						$dataAr[$venue['id_venue']] = $venue['name'];
					}
					reset($dataAr);
					
					$venuesSELECT = BaseHtmlLib::selectElement2('id:venuesList,name:venuesList',$dataAr,key($dataAr));
					unset($dataAr);
					
					$venuesLABEL = CDOMElement::create('label','for:venuesList,class:venuesListLabel');
					$venuesLABEL->addChild(new CText(translateFN('Seleziona un luogo').': '));
					
					$classroomSPAN = CDOMElement::create('span','class:selectclassroomspan');
					$classroomSPAN->addChild(new CText(translateFN('Seleziona una classe').': '));
					$classroomlistDIV = CDOMElement::create('div','id:classroomlist');
					
					$classroomsDIV->addChild ($venuesLABEL);
					$classroomsDIV->addChild ($venuesSELECT);
					$classroomsDIV->addChild($classroomSPAN);
					$classroomsDIV->addChild($classroomlistDIV);
				}
				
				
				/**
				 * add all generated elements to the container
				 */
				if (isset($selectClassDIV)) {
					$htmlObj->addChild($selectClassDIV);
				}
				$htmlObj->addChild($calendarDIV);
				if (isset($classroomsDIV)) {
					$htmlObj->addChild($classroomsDIV);					
				}
				$htmlObj->addChild(CDOMElement::create('div','class:clearfix'));
				$htmlObj->addChild($saveButton);
				
				break;				
			default:
				/**
				 * return an empty page as default action
				 */
				break;
		}
		
		return array(
			'htmlObj'   => $htmlObj,
			'help'      => $help,
			'title'     => $title,
		);
	}
	
	private function _getVenues() {
		if (defined('MODULES_CLASSROOM') && MODULES_CLASSROOM) {
			require_once MODULES_CLASSROOM_PATH . '/include/classroomAPI.inc.php';
			$classroomAPI = new classroomAPI();
			return $classroomAPI->getAllVenues();
		} else return null;
	}
	
	private function _getInstances() {
		$dh = $GLOBALS['dh'];
		// grab some course and course instance datas to build up the form properly
		$formCourseList = array();
		
		// first of all, get the coure list
		$courseList = $dh->get_courses_list(array('titolo'));
		// first element of returned array is always the courseId, array is NOT assoc
		if (!AMA_DB::isError($courseList)) {
			// for each course in the list...
			foreach ($courseList as $courseItem) {
				// ... get the subscribeable course instance list...
				$courseInstances = $dh->course_instance_get_list(array('title'), $courseItem[0]);
				// first element of returned array is always the instanceId, array is NOT assoc
				if (!AMA_DB::isError($courseInstances)) {
					// ...and, for each subscribeable instance in the list...
					foreach ($courseInstances as $courseInstanceItem) {
						// ... put its ID and human readble course instance name, course title and course name as an <option> in the <select>
						$formCourseList[] = array ( 'id'=>$courseInstanceItem[0] , 'title'=>$courseItem[1] . " > ".$courseInstanceItem[1] );
					}
				}
			}
		}	
		
		return $formCourseList;
	}
	
} // class ends here