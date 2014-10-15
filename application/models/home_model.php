<?php

class Home_Model extends CI_Model{
	public function get_asset_mitra_input_chart($Tahun){
		$qry = "
				
				SELECT  (
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 1 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Januari ,
					(
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 2 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Febuari ,
					(
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 3 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Maret ,
					(	
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 4 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS April ,
					(
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 5 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Mei ,
					(
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 6 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Juni ,
					(	
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 7 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Juli ,
					(	
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 8 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Agustus ,
					(	
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 9 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS September ,
					(	
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 10 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Oktober ,
					(	
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 11 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Nopember ,
					(	
					SELECT COUNT(*)
					FROM aset_hbm WHERE MONTH(CREATED_DATE) = 12 AND YEAR(CREATED_DATE) = " . $Tahun . "
					) AS Desember;
							
				";
		$query = $this->db->query($qry);
		return $query->row();
	}
	
	public function get_sp3saldo_mitra_input_chart(){
		$qry = "
				
				SELECT (SUM(SALDO_AKHIR)/1000000) AS SALDO_AKHIR, OPERATOR_CODE
				FROM sp3_saldo
				GROUP BY OPERATOR_CODE
				
				";		
		
		$query = $this->db->query($qry);
		return $query->result();
	}
	
	public function get_asr_input_setoran_chart($Tahun){
		$qry = '
				
				SELECT ((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-01-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-01-01")) / 1000000 AS JANUARI_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 1 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS JANUARI_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 1 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS JANUARI_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-02-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-02-01")) / 1000000 AS FEBUARI_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 2 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS FEBUARI_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 2 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS FEBUARI_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-03-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-03-01")) / 1000000 AS MARET_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 3 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS MARET_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 3 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS MARET_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-04-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-04-01")) / 1000000 AS APRIL_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 4 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS APRIL_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 4 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS APRIL_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-05-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-05-01"))  / 1000000 AS MEI_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 5 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS MEI_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 5 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS MEI_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-06-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-06-01")) / 1000000 AS JUNI_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 6 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS JUNI_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 6 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS JUNI_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-07-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-07-01")) / 1000000 AS JULI_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 7 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS JULI_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 7 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS JULI_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-08-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-08-01")) / 1000000 AS AGUSTUS_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 8 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS AGUSTUS_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 8 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS AGUSTUS_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-09-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-09-01")) / 1000000 AS SEPTEMBER_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 9 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS SEPTEMBER_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 9 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS SEPTEMBER_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-10-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-10-01")) / 1000000 AS OKTOBER_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 10 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS OKTOBER_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 10 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS OKTOBER_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-11-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-11-01")) / 1000000 AS NOPEMBER_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 11 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS NOPEMBER_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 11 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS NOPEMBER_LESS,
						
					((SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND CREATED_DATE < "'.$Tahun.'-12-01")  - 
						(SELECT SUM(AMOUNT)
							FROM asr_balance_mitra
							WHERE ADD_LESS = 2 AND CREATED_DATE < "'.$Tahun.'-12-01")) / 1000000 AS DESEMBER_SALDO,	
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 1 AND MONTH(CREATED_DATE) = 12 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS DESEMBER_ADD,
					(SELECT SUM(AMOUNT)
						FROM asr_balance_mitra
						WHERE ADD_LESS = 2 AND MONTH(CREATED_DATE) = 12 AND YEAR(CREATED_DATE) = '.$Tahun.') / 1000000 AS DESEMBER_LESS
			
				
				';
		$query = $this->db->query($qry);
		return $query->row();
	}
	
	public function get_afe_input_approval_chart(){
		$qry = "
				
				SELECT
				(
				    SELECT COUNT(STATUS_AFE)
				    FROM   afe_approval
				    WHERE STATUS_AFE = 3
				    ) + (
					    SELECT COUNT(STATUS_AFE)
					    FROM   afe_approval_revision
					    WHERE STATUS_AFE = 3
					    ) + (
						    SELECT COUNT(STATUS_AFE)
						    FROM   afe_closeout_approval
						    WHERE STATUS_AFE = 3
						    
						    ) AS USULAN_DISETUJUI,
						    
				(
				    SELECT COUNT(STATUS_AFE)
				    FROM   afe_approval
				    WHERE STATUS_AFE = 4
				    ) + (
					    SELECT COUNT(STATUS_AFE)
					    FROM   afe_approval_revision
					    WHERE STATUS_AFE = 4
					    ) + (
						    SELECT COUNT(STATUS_AFE)
						    FROM   afe_closeout_approval
						    WHERE STATUS_AFE = 4
						    
						    ) AS USULAN_DITOLAK,		    
						    
				(
				    SELECT COUNT(STATUS_AFE)
				    FROM   afe_approval
				    WHERE STATUS_AFE = 7
				    ) + (
					    SELECT COUNT(STATUS_AFE)
					    FROM   afe_approval_revision
					    WHERE STATUS_AFE = 7
					    ) + (
						    SELECT COUNT(STATUS_AFE)
						    FROM   afe_closeout_approval
						    WHERE STATUS_AFE = 7
						    
						    ) AS REVISI_DISETUJUI,		    
						    
				(
				    SELECT COUNT(STATUS_AFE)
				    FROM   afe_approval
				    WHERE STATUS_AFE = 8
				    ) + (
					    SELECT COUNT(STATUS_AFE)
					    FROM   afe_approval_revision
					    WHERE STATUS_AFE = 8
					    ) + (
						    SELECT COUNT(STATUS_AFE)
						    FROM   afe_closeout_approval
						    WHERE STATUS_AFE = 8
						    
						    ) AS REVISI_DITOLAK,		    
						    
				(
				    SELECT COUNT(STATUS_AFE)
				    FROM   afe_approval
				    WHERE STATUS_AFE = 11
				    ) + (
					    SELECT COUNT(STATUS_AFE)
					    FROM   afe_approval_revision
					    WHERE STATUS_AFE = 11
					    ) + (
						    SELECT COUNT(STATUS_AFE)
						    FROM   afe_closeout_approval
						    WHERE STATUS_AFE = 11
						    
						    ) AS CLOSEOUT_DISETUJUI,		    
						    
				(
				    SELECT COUNT(STATUS_AFE)
				    FROM   afe_approval
				    WHERE STATUS_AFE = 12
				    ) + (
					    SELECT COUNT(STATUS_AFE)
					    FROM   afe_approval_revision
					    WHERE STATUS_AFE = 12
					    ) + (
						    SELECT COUNT(STATUS_AFE)
						    FROM   afe_closeout_approval
						    WHERE STATUS_AFE = 12
						    
						    ) AS CLOSEOUT_DITOLAK
			
					";		
		$query = $this->db->query($qry);
		return $query->row();
	}	
	
}