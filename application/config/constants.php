<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

// Constanta untuk Modul SP3
define('SP3_DAFTAR_MODEL'	,'sp3/daftartransaksi_model');
define('SP3_DAFTAR_VIEW'	,'sp3/daftartransaksi_view');
define('SP3_TAMBAH_VIEW'	,'sp3/tambahtransaksi_view');
define('SP3_TAMBAH_MODEL'	,'sp3/tambahtransaksi_model');
define('SP3_TAMBAH_FORM'	,'sp3/tambahtransaksi/entry_form');
define('SP3_REPORTING_MODEL','sp3/daftarsp3mitra_model');
define('SP3_REPORTING_VIEW'	,'sp3/daftarsp3mitra_view');

define('SP3_DAFTAR_FORM'	,'sp3/daftartransaksi/form');
define('SP3_DETAIL_MODEL', 'sp3/detailsaldo_model');

define('SP3_DETAIL_FORM', 'sp3/detailsaldo/form');
define('SP3_DETAIL_VIEW', 'sp3/detailsaldo_view');
define('SP3_EDIT_VIEW', 'sp3/edittransaksi_view');

// Constant untuk Modul User Management
define('USER_LIST_DATAMASTER_MODEL','user/list_datamaster_model');
define('USER_LIST_DATAMASTER_VIEW','user/list_datamaster_view');
define('USER_LIST_DATAMASTER_FORM','user/list_datamaster/form');
define('USER_INPUT_DATAMASTER_VIEW','user/input_datamaster_view');
define('USER_INPUT_DATAMASTER_FORM','user/input_datamaster/form');
define('USER_INPUT_DATAMASTER_MODEL', 'user/input_datamaster_model');

// Constanta untuk Modul AFE
define('AFE_DAFTAR_MODEL'	,'afe/daftarafe_model');
define('AFE_DAFTAR_APPROVAL_MODEL'	,'afe/daftarapprovalafe_model');
define('AFE_DAFTAR_APPROVAL_REV_MODEL'	,'afe/daftarapprovalrevisiafe_model');
define('AFE_DAFTAR_VIEW'	,'afe/daftarafe_view');
define('AFE_DAFTAR_APPROVAL_VIEW'	,'afe/daftarapproval_view');
define('AFE_DAFTAR_APPROVAL_REV_VIEW'	,'afe/daftarapprovalrevisi_view');
define('AFE_DAFTARAPPROVALREVISI_SUBMIT'	,'afe/daftarapprovalrevisi/approvalrevisiafe_submit');
define('AFE_APPROVAL_VIEW'	,'afe/approvalafe_view');
define('AFE_TAMBAH'	,'afe/tambahafe');
define('AFE_TAMBAH_VIEW'	,'afe/tambahafe_view');
define('AFE_TAMBAH_MODEL'	,'afe/tambahafe_model');
define('AFE_TAMBAH_FORM'	,'afe/daftarafe/afe_submit');
define('AFE_DETAIL_VIEW'	,'afe/detailafe_view');
define('AFE_DETAIL_MODEL'	,'afe/detailafe_model');
define('AFE_DETAIL_FORM'	,'afe/detailafe/form');
define('AFE_DAFTARREVISI_MODEL'	,'afe/daftarrevisiafe_model');
define('AFE_DAFTARREVISI_VIEW'	,'afe/daftarrevisiafe_view');
define('AFE_DAFTARREVISI_FORM'	,'afe/daftarrevisiafe/form');
define('AFE_DAFTARREVISI_SUBMIT'	,'afe/daftarrevisiafe/revisiafe_submit');
define('AFE_DAFTARCLOSEOUT_MODEL'	,'afe/daftarcloseout_model');
define('AFE_DAFTARCLOSEOUT_VIEW'	,'afe/daftarcloseout_view');
define('AFE_DAFTARCLOSEOUT_FORM'	,'afe/daftarcloseout/form');
define('AFE_DAFTARCLOSEOUT_SUBMIT'	,'afe/daftarcloseout/closeout_submit');
define('AFE_DAFTARAPPCLOSEOUT_MODEL'	,'afe/daftarapprovalcloseout_model');
define('AFE_DAFTARAPPCLOSEOUT_VIEW'	,'afe/daftarapprovalcloseout_view');
define('AFE_DAFTARAPPCLOSEOUT_FORM'	,'afe/daftarapprovalcloseout/form');
define('AFE_DAFTARAPPCLOSEOUT_SUBMIT'	,'afe/daftarapprovalcloseout/approvalcloseout_submit');

// Constanta untuk Modul ASSET
define('ASSET_CONT_LIST_TRANSACTION'	,'asset/listtransaction');
define('ASSET_VIEW_LIST_TRANSACTION'	,'asset/listtransaction_view');
define('ASSET_MODEL_LIST_TRANSACTION'	,'asset/listtransaction_model');
/* End of file constants.php */
/* Location: ./application/config/constants.php */