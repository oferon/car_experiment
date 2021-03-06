<?php
namespace carexperiment;

include_once __DIR__ . '/../includes/DbConnectInfo.php';
include_once 'DataCtrl.php';
include_once __DIR__ . '/../model/FormField.php';


use \mysqli as mysqli;
use \stdClass as stdClass;
use \FormField as FormField; 
use carexperiment\DataCtrl as DataCtrl;


class GameDataCtrl extends DataCtrl {

    private $mysqli_con;

    //Class constructor
    function __construct(mysqli $mysqli_con = null) {

        parent::__construct();

        $dbinfo = \DbConnectInfo::getDBConnectInfoObject();

        if (!$mysqli_con) {
            @$this->mysqli_con = new mysqli($dbinfo->getServer(), $dbinfo->getUserName(), $dbinfo->getPassword(), $dbinfo->getDatabaseName(), $dbinfo->getPort());

            if ($this->mysqli_con->connect_errno) {
                $this->throwDBExceptionOnError($this->mysqli_con->connect_errno, $this->mysqli_con->connect_error);
            }
        }
        else {
            $this->mysqli_con = $mysqli_con;
        }
    }

    function recordSurveyClick($user_id,$action, $state) {

        $query = "INSERT INTO flappy_car VALUES(null,now(),?,?,?)";

        if (!$stmt = $this->mysqli_con->prepare($query)) {
            $this->throwDBExceptionOnError($this->mysqli_con->errno, $this->mysqli_con->error);
        }

        if (!$stmt->bind_param('iii',$user_id, $action, $state)) {
            $this->throwDBExceptionOnError($this->mysqli_con->errno, $this->mysqli_con->error);
        }

        if (!$stmt->execute()) {
            $this->throwDBExceptionOnError($stmt->errno, $stmt->error);
        }

        $stmt->close();
    }
    
    
    
    function recordSuveyResult(array $form_fields, $user_id)
    {
        
        $fields = ['survey_id'=>0,'Q1'=>null,'Q2'=>null,'Q3'=>null,'Q4'=>null,'Q5'=>null,'Q6'=>null,'Q7'=>null,'Q8'=>null,'Q9'=>null,'Q10'=>null,'Q11'=>null,'Q12'=>null,'Q13'=>null,'Q14'=>null,'Q15'=>null];
        
        /* @var $field FormField */
        foreach($form_fields as $field)
        {
            if( array_key_exists($field->getName(),$fields))
            {
                $fields[$field->getName()] = $field->getValue();
            }
        }
        
        
        
        $query = "INSERT INTO `surveys` (`user_id`,`survey_id`,`date`,`Question1`,`Question2`,`Question3`,`Question4`,`Question5`,`Question6`,`Question7`,`Question8`,`Question9`,`Question10`,`Question11`,`Question12`,`Question13`,`Question14`,`Question15`) VALUES (?,?,now(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if (!$stmt = $this->mysqli_con->prepare($query)) {
            $this->throwDBExceptionOnError($this->mysqli_con->errno, $this->mysqli_con->error);
        }

        if (!$stmt->bind_param('iisssssssssssssss', $user_id, $fields['survey_id'],$fields['Q1'],$fields['Q2'],$fields['Q3'],$fields['Q4'],$fields['Q5'],$fields['Q6'],$fields['Q7'],$fields['Q8'],$fields['Q9'],$fields['Q10'],$fields['Q11'],$fields['Q12'],$fields['Q13'],$fields['Q14'],$fields['Q15'])) {
            $this->throwDBExceptionOnError($this->mysqli_con->errno, $this->mysqli_con->error);
        }

        if (!$stmt->execute()) {
            $this->throwDBExceptionOnError($stmt->errno, $stmt->error);
        }

        $stmt->close();
        
        
    }
    
    function get_performance()
    {
        //scores submitted during last 3 minutes: 
        $scores_submitted="select count(*) from U311.flappy_car where time-( now() - INTERVAL 3 minute)>0 and time-( now() - INTERVAL 20 second)<0 and user_action<6 and user_action>0; ";
        if( ! $stmt = mysqli_prepare($this->mysqli_con, $scores_submitted)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }
        if( ! mysqli_stmt_execute($stmt)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }
        $scores_num = null;
        
        if( ! mysqli_stmt_bind_result($stmt, $scores_num)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }      
       mysqli_stmt_fetch($stmt);
       mysqli_stmt_close($stmt);

       
       //shuttle choices during last 2 minutes: 
       $shuttle_choices="select count(*) from flappy_car where time-( now() - INTERVAL 3 minute)>0 and time-( now() - INTERVAL 20 second)<0 and user_action=3000; ";
        if( ! $stmt = mysqli_prepare($this->mysqli_con, $shuttle_choices)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }
        if( ! mysqli_stmt_execute($stmt)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }
        $rides_num = null;
        
        if( ! mysqli_stmt_bind_result($stmt, $rides_num)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }      
       mysqli_stmt_fetch($stmt);
       mysqli_stmt_close($stmt); 
       
       
       
       //detour choices during last 2 minutes: 
       $detour_choices="select count(*) from flappy_car where time-( now() - INTERVAL 3 minute)>0 and time-( now() - INTERVAL 20 second)<0 and user_action=2000; ";
       if( ! $stmt = mysqli_prepare($this->mysqli_con, $detour_choices)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }
        if( ! mysqli_stmt_execute($stmt)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }
        $detours_num = null;
        
        if( ! mysqli_stmt_bind_result($stmt, $detours_num)){
            $this->throwDBError($this->mysqli_con->error, $this->mysqli_con->errno);
        }      
       mysqli_stmt_fetch($stmt);
       mysqli_stmt_close($stmt);   
       
       
       if(($rides_num+$detours_num)<2){ $performance=0.5; } // not enough data
       else{ $performance=$scores_num/($rides_num+$detours_num); }
      
       return $performance;    
    }
}


