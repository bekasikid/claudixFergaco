<?php

// ganti fungsi ini, jgn pake echo!
function print_dump($pVar) {
	if (!empty($pVar)) {
		echo '<pre>';
		print_r($pVar);
		echo '</pre>';
	}
}

function zebra_table($no) {
	return ($no%2==0) ? '#e6e6e6' : FALSE;
}

// split value by char then takes the first array
function explode_before_char($val, $char) {
	$part = explode($char, $val);
	return $part['0'];
}
// split value by char then takes the index array
function explode_char_index($val, $char, $index) {	// the $index is string
	$part = explode($char, $val);
	return $part[$index];
}

function generate_unique_id($prefix) {
	return uniqid($prefix);
}

function generate_sequence_id($value) {
	if ($value==null) { // ato 0
		$count=1;
	} else {
		$count=$value+1;	// Bug $value++
	}
	return $count;	
}
/******* generate sequence auto increment unt semua table [MUSTI INHERIT OBJECT db DULU !!] ************/
// function generate_sequence_id_current_table($table, $field_id) {
// 	$this->db->select_max($field_id);
// 	$filled = $this->db->get($table)->row();
// 	if ($filled) {
// 		return generate_sequence_id($filled->$field_id);
// 	} else {
// 		return generate_sequence_id(0);	
// 	}
// }

/******* Currency Helpers ************/ 
function format_uang($val) {
	return number_format($val, 2);
}
function unformat_uang($val) {
	// if ( strstr( $number, ',' ) ) $number = str_replace( ',', '', $number );  
	return str_replace( ',', '', $val );
}


/******* Date Helpers ************/ 

// Date now in "Y-m-d"
function date_now() {
	return date('Y-m-d', now());
}
function date_now_dmy() {
	return date('d-M-Y', now());
}

// Basic format date by "Y-m-d"
function format_date($date) {
	return date("d-M-Y", strtotime($date));
}

// String to date by "Y-m-d"
function string_date_ymd($year, $month) {
	return date("Y-m-d", strtotime($year."-".$month."-1") );
}
// get month from date
function get_month($date) {
	return date("m", strtotime($date));
}
// get month from date
function get_year($date) {
	return date("Y", strtotime($date));
}
// exam format July 2010
function format_month_year($date) {
	return date("F Y", strtotime($date));
}
// exam format July 2010
function format_month_name($date) {
	return date("F", strtotime($date));
}
// dropdown hard code bulan
function init_ddown_bulan() {
	return array(
			'0' => '-',
			'1' => 'January',
			'2' => 'February',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'May',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
	);
}
function init_ddown_bulan_2digit() {
	return array(
			'0' => '-',
			'01' => 'January',
			'02' => 'February',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'May',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
	);
}
function init_bulan_cnd() {
	return array(
			'-'	=> '-',
			'1' => 'January',
			'2' => 'February',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'May',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
	);
}


// init hard code currency
function init_ddown_currency() {
// 	return array('0' => "-", 'IDR' => "IDR", 'USD' => "USD");
	return array('0' => "-", '2' => "IDR", '1' => "USD");
}
// unt drop down tahun
function init_ddown_tahun() {
	$group_tahun = array();
	for($i = 100;$i>1;$i--){
// 		array_push($group_tahun, $i + (date('Y')-100));	// SALAH
		$d = $i + (date('Y')-100);
		$group_tahun[$d] = $d;
	}	
	return $group_tahun;
}	

function init_up_down_year() {
	$def_year = date('Y');
	$before = $def_year -30;
	
	for($i = $before; $i < $def_year +10; $i++) {
		$result[$i] = $i;
	}
	return $result;
	
// 	return array_merge(range(date('Y')-10, date('Y')), range(date('Y')+1, date('Y')+10));
}

// jeri tambah untuk default sp3 diminta dari tahun 1990 - 2035
function init_sp3_year() {
	$def_year = date('Y');
	$before = 1990;

	for($i = $before; $i < $def_year +24; $i++) {
		$result[$i] = $i;
	}
	return $result;

	// 	return array_merge(range(date('Y')-10, date('Y')), range(date('Y')+1, date('Y')+10));
}

// dropdown master type
function init_master_type() { 
	return $group_tac = array(
			'0' => "ALL",
			'TAC' => "TAC",
			'KSO' => "KSO",
			'JOB' => "JOB"
	);
}

function getCurrType($type){
// 	return ($type=="IDR") ? "IDR" : ($type=="USD") ? "USD" : "n/a"; 	// NGACO!!
	return $type;
}

function textboxUpdateForm($data,$field){
	if(isset($data)){
		return $data->$field;
	}else{
		return "";
	}
}
/*** dropdown arrays ***/
function dropdown_arr($results, $field1, $field2) {	
	$options = array();
	foreach ($results as $value) {
		if ( isset($field2) ) {
			$options[$value->$field1] = $value->$field1 ." - ". $value->$field2;
		} else {
			$options[$value->$field1] = $value->$field1;
		}
	}
	return $options;
}
// function dropdown_arr_na($results, $field) {
// 	$options = array('0'=>' -- n/a -- ');
// 	foreach ($results as $value) {
// 		$options[$value->$field] = $value->$field;
// 	}
// 	return $options;
// }

/*** jeri nambah hilangkan value field 2 untuk tampil arrays ***/
function dropdown_arr_field1($results, $field1, $field2, $addDash = false) {
	$options = array();
	
	if($addDash){
		$options['-'] = '-';
	}
	
	foreach ($results as $value) {
		if ( isset($field2) ) {
			$options[$value->$field1] = $value->$field2;
		} else {
			$options[$value->$field1] = $value->$field1;
		}
	}
	return $options;
}

/** Validation Helper **/
function is_zero_char($char) {
	return ($char=='0') ? true : false;
}



/*** auto complete helper for asset reporting status ***/
function input_operator($session_data){
	// jk user mitra hny sesuai kode operator 
	if($session_data['user_info']->ID_MODUL_ROLE == 1){
		?>
        <input type="text" name="OPR_TEXT" size="60" id="OPR_TEXT" value="<?php echo $session_data['user_info']->OPERATOR_CODE;?>" required placeholder="Operator"/>
        <input type="hidden" name="OPERATOR_CODE" id="OPERATOR_CODE" value="<?php echo $session_data['user_info']->OPERATOR_CODE;?>"/>
        <?php
    } else {
    ?>
        <input type="text" name="OPR_TEXT" id="OPR_TEXT" value="" required placeholder="Cari Mitra"/>
        <input type="hidden" name="OPERATOR_CODE" id="OPERATOR_CODE" value=""/>
        <script type="text/javascript">
            $(function () {
                $("#OPR_TEXT" ).autocomplete({
                    source: "<?php echo site_url('user/list_datamaster/ajax_mitra');?>/"+$(this).val(),
                    minLength: 2,
                    select: function( event, ui ) {
                        $("#OPERATOR_CODE").val(ui.item.id);
                    },
                    search : function (){ }
                });
            });
        </script>
    <?php
    }
}

