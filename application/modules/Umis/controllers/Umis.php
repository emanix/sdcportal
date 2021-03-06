<?php

class Umis extends MY_Controller{

    function __construct()
    {
        parent::__construct();

    }

    function getMajors()
    {
        $xml = "<QUERY>\n";
        $xml .= "	<GRID name=\"Majors\" keyfield=\"majorid\" table=\"majors\">\n";
        $xml .= "		<TEXTFIELD>departmentid</TEXTFIELD>\n";
        $xml .= "		<TEXTFIELD>majorname</TEXTFIELD>\n";
        $xml .= "	</GRID>\n";
        $xml .= "</QUERY>\n";

        return $xml;
    }

    function getSchools()
    {
        $xml = "<QUERY>\n";
        $xml .= "	<GRID name=\"Schools\" keyfield=\"schoolid\" table=\"schools\">\n";
        $xml .= "		<TEXTFIELD>schoolname</TEXTFIELD>\n";
        $xml .= "	</GRID>\n";
        $xml .= "</QUERY>\n";

        return $xml;
    }

     function getSemesters() {
        $xml = "<QUERY>\n";
        $xml .= "    <GRID name=\"Semesters\" keyfield=\"quarterid\" table=\"quarters\">\n";
        //$xml .= "        <TEXTFIELD>qstart</TEXTFIELD>\n";
        $xml .= "        <TEXTFIELD>quarterid</TEXTFIELD>\n";
        $xml .= "        <TEXTFIELD>active</TEXTFIELD>\n";
        $xml .= "        <TEXTFIELD>publishgrades</TEXTFIELD>\n";
        $xml .= "    </GRID>\n";
        $xml .= "</QUERY>\n";

        return $xml;
    }

    function getDepartments()
    {
        $xml = "<QUERY>\n";
        $xml .= "	<GRID name=\"Departments\" keyfield=\"departmentid\" table=\"departments\">\n";
        $xml .= "		<TEXTFIELD>schoolid</TEXTFIELD>\n";
        $xml .= "		<TEXTFIELD>departmentname</TEXTFIELD>\n";
        $xml .= "	</GRID>\n";
        $xml .= "</QUERY>\n";

        return $xml;
    }

    function getStudentInfo($quarterid, $studentId) {   
        $xml = "<QUERY>\n";
        //$xml .= "<GRID name=\"Hall Service\" keyfield=\"studentid\" ";
        //$xml .= "table=\"ws_hall_service\" where=\"(studentid = '" . $studentId . "')\">\n";
        $xml .= "<GRID name=\"Semester Student List\" keyfield=\"qstudentid\" table=\"ws_qstudents\" ";
        $xml .= "where=\"(quarterid = '" . $quarterid . "') AND (studentid = '" . $studentId . "')\">\n";
        $xml .= "   <TEXTFIELD>studentid</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>studentname</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>quarterid</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>schoolid</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>schoolname</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>departmentid</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>departmentname</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>studylevel</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>majorid</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>majorname</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>residenceid</TEXTFIELD>\n";
        $xml .= "   <TEXTFIELD>residencename</TEXTFIELD>\n";
        $xml .= "</GRID>\n";
        $xml .= "</QUERY>\n";
            
        return $xml;
    }

    function load_api($umis_function, $quarterid, $matricno)
    {

        //$this->load->module("Grades");
        try{
            $client = new SoapClient("http://umis.babcock.edu.ng/babcock/webservice?wsdl");
            $params["arg0"] = $this->$umis_function($quarterid, $matricno);
            $params["arg1"] = "babcockWB12345";

            if ($client->_soap_version == 1){
                //echo "version 1";
                $params = array($params);
            }
            $response = $client->__soapCall('getWsData',$params);
            //print_r($params);
            //print_r($response);

            $grades = new SimpleXMLElement($response->return);
            return $grades;

            //print_r($response);

        } catch(SoapFault $exception) {
            echo 'ERROR ::: ' . $exception->getMessage();
        } catch(Exception $ex) {

            echo 'PHP ERROR ::: ' . $ex->getMessage();

        }
    }

    function load_apis($umis_function)
    {

        //$this->load->module("Grades");
        try{
            $client = new SoapClient("http://umis.babcock.edu.ng/babcock/webservice?wsdl");
            $params["arg0"] = $this->$umis_function();
            $params["arg1"] = "babcockWB12345";

            if ($client->_soap_version == 1){
                //echo "version 1";
                $params = array($params);
            }
            $response = $client->__soapCall('getWsData',$params);
            //print_r($params);
            //print_r($response);

            $grades = new SimpleXMLElement($response->return);
            return $grades;

            //print_r($response);

        } catch(SoapFault $exception) {
            echo 'ERROR ::: ' . $exception->getMessage();
        } catch(Exception $ex) {

            echo 'PHP ERROR ::: ' . $ex->getMessage();

        }
    }





}