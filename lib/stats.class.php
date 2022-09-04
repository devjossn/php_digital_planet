<?php
  /**
   * Stats Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: stats.class.php, v1.00 2016-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Stats
  {


      /**
       * Stats::__construct()
       * 
       * @return
       */
      public function __construct()
      {

      }
	  
      /**
       * Stats::exportUsers()
       * 
       * @return
       */
      public static function exportUsers()
      {
          $sql = "
		  SELECT 
			CONCAT(fname, ' ', lname) AS name,
			u.membership_id,
			u.mem_expire,
			u.email,
			u.newsletter,
			u.created,
			m.title AS mtitle
		  FROM
			`" . Users::mTable . "` AS u 
			LEFT JOIN " . Content::mxTable . " AS m 
			  ON m.id = u.membership_id 
		  WHERE (
			  TYPE = 'staff' || TYPE = 'editor' || TYPE = 'member'
			) 
		  ORDER BY u.fname;";
		  
		  $rows = Db::run()->pdoQuery($sql)->results();
		  
          $result = array();
          if (is_array($rows)) {
              foreach ($rows as $i => $val) {
                  $result[$i]['name'] = $val->name;
				  $result[$i]['membership'] = $val->membership_id ? $val->mtitle : '-/-';
				  $result[$i]['mem_expire'] = $val->membership_id ? Date::doDate("long_date", $val->mem_expire) : '-/-';
				  $result[$i]['email'] = $val->email;
				  $result[$i]['newsletter'] = $val->newsletter ? Lang::$word->YES : Lang::$word->NO;
				  $result[$i]['created'] = $val->created;
              }
          }
		  
          return $result;

      }
	  
      /**
       * Stats::userHistory()
       * 
       * @return
       */
      public static function userHistory($id, $order = 'activated')
      {
          $sql = "
		  SELECT 
			um.activated,
			um.membership_id,
			um.transaction_id,
			um.expire,
			um.recurring,
			m.title,
			m.price
		  FROM
			`" . Content::mxhTable . "` AS um 
			LEFT JOIN " . Content::mxTable . " AS m 
			  ON m.id = um.membership_id 
		  WHERE um.user_id = ?
		  ORDER BY um.$order DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array($id))->results();
		  
          return $row ? $row : 0;

      }

      /**
       * Stats::userDownloads()
       * 
       * @return
       */
      public static function userDownloads()
      {
		  $sql = "
		  SELECT 
			t.txn_id,
			t.id,
			t.created,
			p.id AS product_id,
			p.title,
			p.thumb,
			p.slug 
		  FROM
			`" . Product::xTable . "` AS t 
			LEFT JOIN `" . Product::mTable . "` AS p 
			  ON p.id = t.product_id 
		  WHERE t.user_id = ? 
			AND t.status = ? 
			AND p.active = ? 
		  ORDER BY created DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, 1, 1))->results();
		  
          return $row ? $row : 0;

      }
	  
      /**
       * Stats::userTotals()
       * 
       * @return
       */
      public static function userTotals()
      {
          $sql = "
		  SELECT 
		    SUM(total) as total
		  FROM
			`" . Product::xTable . "`
		  WHERE user_id = ?
		  AND product_id = ?
		  GROUP BY user_id;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, 0))->result();
		  
          return $row ? $row->total : 0;

      }
	  
      /**
       * Stats::userProductPayments()
       * 
	   * @param int $id
       * @return
       */
      public static function userProductPayments($id)
      {
          $sql = "
		  SELECT 
		    p.product_id,
			p.txn_id,
		    m.title,
			p.amount,
			p.tax,
			p.coupon,
			p.total,
			p.created,
			p.status
		  FROM
			`" . Product::xTable . "` AS p 
			LEFT JOIN " . Product::mTable . " AS m 
			  ON m.id = p.product_id 
		  WHERE p.user_id =?
		  ORDER BY p.created DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array($id))->results();
		  
          return $row ? $row : 0;

      }
	  
      /**
       * Stats::exportUserProductPayments()
       * 
       * @return
       */
      public static function exportUserProductPayments($id)
      {
          $sql = "
		  SELECT 
		    p.txn_id,
		    m.title,
			p.amount,
			p.tax,
			p.coupon,
			p.total,
			p.currency,
			p.pp,
			p.created
		  FROM
			`" . Product::xTable . "` AS p 
			LEFT JOIN " . Product::mTable . " AS m 
			  ON m.id = p.product_id 
		  WHERE p.user_id =?
		  ORDER BY p.created DESC;";
		  
		  $rows = Db::run()->pdoQuery($sql, array($id))->results();
		  $array = json_decode(json_encode($rows), true);
		  
          return $array ? $array : 0;

      }
	  
      /**
       * Stats::getUserProductPaymentsChart()
       * 
       * @return
       */
      public static function getUserProductPaymentsChart($id)
      {

          $data = array();
          $data['label'] = array();
          $data['color'] = array();
          $data['legend'] = array();
		  $data['preUnits'] = Utility::currencySymbol(); 

          $color = array(
              "#03a9f4",
              "#33BFC1",
              "#ff9800",
              "#e91e63",
              );

          $labels = array(
              Lang::$word->TRX_SALES,
              Lang::$word->TRX_AMOUNT,
              Lang::$word->TRX_TAX,
              Lang::$word->TRX_COUPON,
			  );

		  for ($i = 1; $i <= 12; $i++) {
			  $data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
			  $reg_data[$i] = array(
				  'month' => date('M', mktime(0, 0, 0, $i)),
				  'sales' => 0,
				  'amount' => 0,
				  'tax' => 0,
				  'coupon' => 0);
		  }

		  $sql = ("
			SELECT 
			  COUNT(id) AS sales,
			  SUM(amount) AS amount,
			  SUM(tax) AS tax,
			  SUM(coupon) AS coupon,
			  MONTH(created) as created 
			FROM
			  `" . Product::xTable . "` 
			  WHERE user_id = ?
			GROUP BY MONTH(created);
		  ");
		  $query = Db::run()->pdoQuery($sql, array($id));

		  foreach ($query->results() as $result) {
			  $reg_data[$result->created] = array(
				  'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
				  'sales' => $result->sales,
				  'amount' => $result->amount,
				  'tax' => $result->tax,
				  'coupon' => $result->coupon
				  );
		  }


          foreach ($reg_data as $key => $value) {
              $data['data'][$key][Lang::$word->TRX_SALES] = $value['sales'];
              $data['data'][$key][Lang::$word->TRX_AMOUNT] = $value['amount'];
              $data['data'][$key][Lang::$word->TRX_TAX] = $value['tax'];
              $data['data'][$key][Lang::$word->TRX_COUPON] = $value['coupon'];
          }

          foreach ($labels as $k => $label) {
              $data['label'][] = $label;
              $data['color'][] = $color[$k];
              $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[$k] . '"> </span> ' . $label . '</div>';
          }
          $data['data'] = array_values($data['data']);
          return $data;
      }

      /**
       * Stats::getMembershipPaymentsChart()
       * 
       * @return
       */
      public static function getMembershipPaymentsChart($id)
      {

          $data = array();
          $data['label'] = array();
          $data['color'] = array();
          $data['legend'] = array();
		  $data['preUnits'] = Utility::currencySymbol(); 

          $color = array(
              "#03a9f4",
              "#33BFC1",
              "#ff9800",
              "#e91e63",
              );

          $labels = array(
              Lang::$word->TRX_SALES,
              Lang::$word->TRX_AMOUNT,
              Lang::$word->TRX_TAX,
              Lang::$word->TRX_COUPON,
			  );

		  for ($i = 1; $i <= 12; $i++) {
			  $data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
			  $reg_data[$i] = array(
				  'month' => date('M', mktime(0, 0, 0, $i)),
				  'sales' => 0,
				  'amount' => 0,
				  'tax' => 0,
				  'coupon' => 0);
		  }

		  $sql = ("
			SELECT 
			  COUNT(id) AS sales,
			  SUM(amount) AS amount,
			  SUM(tax) AS tax,
			  SUM(coupon) AS coupon,
			  MONTH(created) as created
			FROM
			  `" . Product::xTable . "` 
			  WHERE membership_id = ?
			  AND status = ?
			GROUP BY MONTH(created);
		  ");
		  $query = Db::run()->pdoQuery($sql, array($id, 1));

		  foreach ($query->results() as $result) {
			  $reg_data[$result->created] = array(
				  'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
				  'sales' => $result->sales,
				  'amount' => $result->amount,
				  'tax' => $result->tax,
				  'coupon' => $result->coupon
				  );
		  }


          foreach ($reg_data as $key => $value) {
              $data['data'][$key][Lang::$word->TRX_SALES] = $value['sales'];
              $data['data'][$key][Lang::$word->TRX_AMOUNT] = $value['amount'];
              $data['data'][$key][Lang::$word->TRX_TAX] = $value['tax'];
              $data['data'][$key][Lang::$word->TRX_COUPON] = $value['coupon'];
          }

          foreach ($labels as $k => $label) {
              $data['label'][] = $label;
              $data['color'][] = $color[$k];
              $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[$k] . '"> </span> ' . $label . '</div>';
          }
          $data['data'] = array_values($data['data']);
          return $data;
      }
	  
      /**
       * Stats::exportMembershipPayments()
       * 
       * @return
       */
      public static function exportMembershipPayments($id)
      {
          $sql = "
		  SELECT 
			p.txn_id,
			CONCAT(u.fname,' ',u.lname) as name,
			p.amount,
			p.tax,
			p.coupon,
			p.total,
			p.currency,
			p.pp,
			p.created
		  FROM
			`" . Product::xTable . "` AS p 
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = p.user_id 
		  WHERE p.membership_id = ?
		  AND p.status = ?
		  ORDER BY p.created DESC;";
		  
		  $rows = Db::run()->pdoQuery($sql, array($id, 1))->results();
		  $array = json_decode(json_encode($rows), true);
		  
          return $array ? $array : 0;

      }
	  
      /**
       * Stats::deleteInactive()
       * 
	   * @param int $days
       * @return
       */
      public static function deleteInactive($days)
      {
          $sql = "
		  DELETE 
		  FROM
			`" . Users::mTable . "` 
		  WHERE DATE(lastlogin) < DATE_SUB(CURDATE(), INTERVAL $days DAY) 
			AND type = ? 
			AND active = ?;";
		  
		  Db::run()->pdoQuery($sql, array("member", "y"))->results();
		  $total = Db::run()->affected();
		  
		  Message::msgReply($total, 'success', Message::formatSuccessMessage($total, Lang::$word->MT_DELINCT_OK));

      }
	  
      /**
       * Stats::deleteBanned()
       * 
	   * @param int $days
       * @return
       */
      public static function deleteBanned()
      {
		  
		  Db::run()->delete(Users::mTable, array("active" => "b"));
		  $total = Db::run()->affected();
		  
		  Message::msgReply($total, 'success', Message::formatSuccessMessage($total, Lang::$word->MT_DELBND_OK));

      }
	  
      /**
       * Stats::emptyCart()
       * 
	   * @param int $days
       * @return
       */
      public static function emptyCart()
      {
          $sql = "
		  DELETE 
		  FROM
			`" . Product::cxTable . "` 
		  WHERE DATE(created) < DATE_SUB(CURDATE(), INTERVAL 1 DAY);";
		  
		  Db::run()->pdoQuery($sql)->results();
		  $total = Db::run()->affected();
		  
		  Message::msgReply($total, 'success', Message::formatSuccessMessage($total, Lang::$word->MT_DELCRT_OK));

      }
	  
      /**
       * Stats::getAllSalesStats()
       * 
       * @return
       */
      public static function getAllSalesStats()
      {
          $range = (isset($_GET['timerange'])) ? Validator::sanitize($_GET['timerange'], "string", 6) : 'all';

          $data = array();
          $data['label'] = array();
          $data['color'] = array();
          $data['legend'] = array();
		  $data['preUnits'] = Utility::currencySymbol(); 
		  
          $color = array(
              "#03a9f4",
              "#33BFC1",
              "#ff9800",
              "#e91e63",
              );
			  
          $labels = array(
              Lang::$word->TRX_SALES,
              Lang::$word->TRX_AMOUNT,
              Lang::$word->TRX_TAX,
              Lang::$word->TRX_COUPON,
			  );
			  
          switch ($range) {
              case 'day':
				for ($i = 0; $i < 24; $i++) {
					$data['data'][$i]['m'] = $i;
					$reg_data[$i] = array(
						'hour' => $i,
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
				
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					HOUR(created) as hour
				  FROM
					`" . Product::xTable . "` 
					WHERE DATE(created) = DATE(NOW())
					AND status = ?
				  GROUP BY HOUR(created)
				  ORDER BY hour ASC;
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->hour] = array(
						'hour' => $result->hour,
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
			  break;
			  
              case 'week':
			   $date_start = strtotime('-' . date('w') . ' days');
				for ($i = 0; $i < 7; $i++) {
					$date = date('Y-m-d', $date_start + ($i * 86400));
					$data['data'][$i]['m'] = Date::dodate("EE", date('D', strtotime($date)));
					$reg_data[date('w', strtotime($date))] = array(
						'day' => date('D', strtotime($date)),
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
				
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					DAYNAME(created) as created
				  FROM
					`" . Product::xTable . "` 
					WHERE DATE(created) >= DATE('" . Validator::sanitize(date('Y-m-d', $date_start), "string", 10) . "')
					AND status = ?
				  GROUP BY DAYNAME(created);
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->created] = array(
						'day' => $result->created,
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
			  break;
				  
              case 'month':
				for ($i = 1; $i <= date('t'); $i++) {
					$date = date('Y') . '-' . date('m') . '-' . $i;
					$data['data'][$i]['m'] = date('d', strtotime($date));
					$reg_data[date('j', strtotime($date))] = array(
						'day' => date('d', strtotime($date)),
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
	  
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					DAY(created) as created
				  FROM
					`" . Product::xTable . "` 
					WHERE MONTH(created) = MONTH(CURDATE())
					AND status = ?
				  GROUP BY DAY(created);
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->created] = array(
						'month' => $result->created,
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
			  break;
			  
              case 'year':
				for ($i = 1; $i <= 12; $i++) {
					$data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
					$reg_data[$i] = array(
						'month' => date('M', mktime(0, 0, 0, $i)),
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
	  
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					MONTH(created) as created
				  FROM
					`" . Product::xTable . "` 
					WHERE YEAR(created) = YEAR(NOW())
					AND status = ?
				  GROUP BY MONTH(created);
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->created] = array(
						'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
	  			  break;
			  
              case 'all':
				for ($i = 1; $i <= 12; $i++) {
					$data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
					$reg_data[$i] = array(
						'month' => date('M', mktime(0, 0, 0, $i)),
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
	  
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					MONTH(created) as created
				  FROM
					`" . Product::xTable . "` 
					WHERE status = ?
				  GROUP BY MONTH(created);
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->created] = array(
						'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
			  break;
			  
		  }
		  
		  foreach ($reg_data as $key => $value) {
			  $data['data'][$key][Lang::$word->TRX_SALES] = $value['sales'];
			  $data['data'][$key][Lang::$word->TRX_AMOUNT] = $value['amount'];
			  $data['data'][$key][Lang::$word->TRX_TAX] = $value['tax'];
			  $data['data'][$key][Lang::$word->TRX_COUPON] = $value['coupon'];
		  }

		  foreach ($labels as $k => $label) {
			  $data['label'][] = $label;
			  $data['color'][] = $color[$k];
			  $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[$k] . '"> </span> ' . $label . '</div>';
		  }
		  $data['data'] = array_values($data['data']);
		  return $data;
	  }
	  
      /**
       * Stats::getAllStats()
       * 
       * @return
       */
      public static function getAllStats()
      {
		  
		  $enddate = (Validator::post('enddate_submit') && $_POST['enddate'] <> "") ? Validator::sanitize(Db::toDate($_POST['enddate_submit'], false)) : date("Y-m-d");
		  $fromdate = Validator::post('fromdate_submit') ? Validator::sanitize(Db::toDate($_POST['fromdate_submit'], false)) : null;
		  
          if (Validator::post('fromdate_submit') && $_POST['fromdate_submit'] <> "") {
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . Product::xTable . "` WHERE `membership_id` = 0 AND `created` BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59' AND status = 1");
              $and = "AND p.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59' AND p.status = 1";

          } else {
			  $counter = Db::run()->count(Product::xTable, "membership_id = 0");
              $and = null;
          }
		  
          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = App::Core()->perpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
			p.*,
			m.title,
			CONCAT(u.fname,' ',u.lname) as name
		  FROM `" . Product::xTable . "` as p 
			LEFT JOIN " . Users::mTable . " AS u 
			  ON p.user_id = u.id
			LEFT JOIN " . Product::mTable . " AS m 
			  ON p.product_id = m.id
		  WHERE p.membership_id = ?
		  $and
		  ORDER BY p.created DESC " . $pager->limit;

          $row = Db::run()->pdoQuery($sql, array(0))->results();
		  
          return ($row) ? [$row, $pager] : 0;
		  
	  }
	  
	        /**
       * Stats::exportAllTransactions()
       * 
       * @return
       */
      public static function exportAllTransactions()
      {
          $sql = "
		  SELECT 
			p.txn_id,
			m.title,
			CONCAT(u.fname,' ',u.lname) as name,
			p.amount,
			p.tax,
			p.coupon,
			p.total,
			p.currency,
			p.pp,
			p.created
		  FROM
			`" . Product::xTable . "` AS p 
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = p.user_id 
			LEFT JOIN `" . Product::mTable . "` AS m 
			  ON m.id = p.product_id 
		  WHERE p.membership_id = ?
		  ORDER BY p.created DESC;";
		  
		  $rows = Db::run()->pdoQuery($sql, array(0))->results();
		  $array = json_decode(json_encode($rows), true);
		  
          return $array ? $array : 0;

      }  

      /**
       * Stats::itemChart()
       * 
	   * @param int $id
       * @return
       */
      public static function itemChart($id)
      {

          $data = array();
          $data['label'] = array();
          $data['color'] = array();
          $data['legend'] = array();
		  $data['preUnits'] = Utility::currencySymbol(); 

          $color = array(
              "#03a9f4",
              "#33BFC1",
              "#ff9800",
              "#e91e63",
              );

          $labels = array(
              Lang::$word->TRX_SALES,
              Lang::$word->TRX_AMOUNT,
              Lang::$word->TRX_TAX,
              Lang::$word->TRX_COUPON,
			  );

		  for ($i = 1; $i <= 12; $i++) {
			  $data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
			  $reg_data[$i] = array(
				  'month' => date('M', mktime(0, 0, 0, $i)),
				  'sales' => 0,
				  'amount' => 0,
				  'tax' => 0,
				  'coupon' => 0,
				  );
		  }

		  $sql = ("
			SELECT 
			  COUNT(id) AS sales,
			  SUM(amount) AS amount,
			  SUM(tax) AS tax,
			  SUM(coupon) AS coupon,
			  MONTH(created) as created
			FROM
			  `" . Product::xTable . "` 
			  WHERE product_id = ?
			  AND status = ?
			GROUP BY MONTH(created);
		  ");
		  $query = Db::run()->pdoQuery($sql, array($id, 1));

		  foreach ($query->results() as $result) {
			  $reg_data[$result->created] = array(
				  'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
				  'sales' => $result->sales,
				  'amount' => $result->amount,
				  'tax' => $result->tax,
				  'coupon' => $result->coupon
				  );
		  }

          foreach ($reg_data as $key => $value) {
              $data['data'][$key][Lang::$word->TRX_SALES] = $value['sales'];
              $data['data'][$key][Lang::$word->TRX_AMOUNT] = $value['amount'];
              $data['data'][$key][Lang::$word->TRX_TAX] = $value['tax'];
              $data['data'][$key][Lang::$word->TRX_COUPON] = $value['coupon'];
          }

          foreach ($labels as $k => $label) {
              $data['label'][] = $label;
              $data['color'][] = $color[$k];
              $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[$k] . '"> </span> ' . $label . '</div>';
          }
          $data['data'] = array_values($data['data']);
		  
          return $data;
      }

      /**
       * Stats::itemPayments()
       * 
	   * @param int $id
       * @return
       */
      public static function itemPayments($id)
      {
          $sql = "
		  SELECT 
			p.txn_id,
			CONCAT(u.fname,' ',u.lname) as name,
			p.amount,
			p.tax,
			p.coupon,
			p.total,
			p.currency,
			p.pp,
			p.created
		  FROM
			`" . Product::xTable . "` AS p 
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = p.user_id 
		  WHERE p.product_id = ?
		  AND p.status = ?
		  ORDER BY p.created DESC;";
		  
		  $rows = Db::run()->pdoQuery($sql, array($id, 1))->results();
		  $array = json_decode(json_encode($rows), true);
		  
          return $array ? $array : 0;

      }
	  
      /**
       * Stats::indexStats()
       * 
       * @return
       */
      public static function indexStats()
      {
		  
		  $users = Db::run()->count(Users::mTable, "type = 'member'");
		  $active = Db::run()->count(Users::mTable, "active = 'y' AND type = 'member'");
		  $mems = Db::run()->count(Users::mTable, "membership_id <> 0 AND type = 'member'");
		  $prods = Db::run()->count(Product::mTable);
		  
		  return [$users, $active, $mems, $prods];
		  
	  }

      /**
       * Stats::indexSalesStats()
       * 
       * @return
       */
      public static function indexSalesStats()
      {

          $data = array();
          $data['label'] = array();
          $data['color'] = array();
          $data['legend'] = array();
		  $data['preUnits'] = Utility::currencySymbol(); 
		  
          $color = array(
              "#56baed",
              "#4DB6AC"
              );
			  
          $labels = array(
              Lang::$word->TRX_SALES,
              Lang::$word->TRX_AMOUNT
			  );

		  for ($i = 1; $i <= 12; $i++) {
			  $data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
			  $reg_data[$i] = array(
				  'month' => date('M', mktime(0, 0, 0, $i)),
				  'sales' => 0,
				  'amount' => 0,
				  );
		  }

          $sql = "
		  SELECT 
			COUNT(id) AS sales,
			SUM(amount) AS amount,
			MONTH(created) as created
		  FROM
			`" . Product::xTable . "` 
		  WHERE status = ?
		  GROUP BY MONTH(created);";

          $query = Db::run()->pdoQuery($sql, array(1));
          foreach ($query->results() as $result) {
              $reg_data[$result->created] = array(
                  'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
                  'sales' => $result->sales,
                  'amount' => $result->amount);
          }

          $totalsum = 0;
          $totalsales = 0;
		  
		  
          foreach ($reg_data as $key => $value) {
              $data['sales'][] = array($key, $value['sales']);
              $data['amount'][] = array($key, $value['amount']);
			  $data['data'][$key][Lang::$word->TRX_SALES] = $value['sales'];
			  $data['data'][$key][Lang::$word->TRX_AMOUNT] = $value['amount'];
              $totalsum += $value['amount'];
              $totalsales += $value['sales'];
          }

          $data['totalsum'] = $totalsum;
          $data['totalsales'] = $totalsales;
          $data['sales_str'] = implode(",", array_column($data["sales"], 1));
          $data['amount_str'] = implode(",", array_column($data["amount"], 1));

          foreach ($labels as $k => $label) {
              $data['label'][] = $label;
              $data['color'][] = $color[$k];
              $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[$k] . '"> </span> ' . $label . '</div>';
          }
		  $data['data'] = array_values($data['data']);
          return ($data) ? $data : 0;

      }

      /**
       * Stats::getMainMembershipStats()
       * 
       * @return
       */
      public static function getMainMembershipStats()
      {
          $data = array();
          $data['label'] = array();
          $data['color'] = array();
          $data['legend'] = array();
		  $data['preUnits'] = Utility::currencySymbol(); 

          $color = array(
              "#f44336",
              "#2196f3",
              "#e91e63",
              "#4caf50",
              "#ff9800",
              "#ff5722",
              "#795548",
              "#607d8b",
              "#00bcd4",
              "#9c27b0");

          $begin = new DateTime(date('Y') . '-01');
          $ends = new DateTime(date('Y') . '-12');
          $end = $ends->modify('+1 month');

          $interval = new DateInterval('P1M');
          $daterange = new DatePeriod($begin, $interval, $end);

          $sql = "
		  SELECT 
			DATE_FORMAT(p.created, '%Y-%m') as cdate,
			m.title,
			p.membership_id,
			p.amount
		  FROM
			`" . Product::xTable . "` AS p 
			LEFT JOIN `" . Content::mxTable . "` AS m 
			  ON m.id = p.membership_id 
		  WHERE p.status = ?
		  AND m.private = ?;";
          $query = Db::run()->pdoQuery($sql, array(1, 0))->results();
          $memberships = Utility::groupToLoop($query, "title");

          foreach ($daterange as $k => $date) {
              $data['data'][$k]['m'] = Date::dodate("MMM", $date->format("Y-m"));
              if ($memberships) {
                  foreach ($memberships as $title => $rows) {
                      $sum = 0;
                      foreach ($rows as $row) {
                          $data['data'][$k][$row->title] = $sum;
                          if ($row->cdate == $date->format("Y-m")) {
                              $sum += $row->amount;
                              $data['data'][$k][$title] = $sum;
                          }
                      }

                  }

              } else {
                  $data['data'][$k]['-/-'] = 0;
              }
          }

          if ($memberships) {
              $k = 0;
              foreach ($memberships as $label => $vals) {
                  $k++;
                  $data['label'][] = $label;
                  $data['color'][] = $color[$k];
                  $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[$k] . '"> </span> ' . $label . '</div>';
              }
          } else {
              $data['label'][] = '-/-';
              $data['color'][] = $color[0];
              $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[0] . '"> </span> -/-</div>';
          }

          return $data;

      }

      /**
       * Stats::fileStats()
       * 
	   * @param array $row
       * @return
       */
	  public static function fileStats($row)
	  {
		  $data = array();
		  $data['expired'] = false;
		  $data['expiry'] = $row->expiry;
		  if ($row->expiry > 0 and $row->status == 1) {
			  //if (substr_count($row->expiry, 'D') != 0) {
			  if ($row->expiry_type == "days") {
				  $expiry = ($row->expiry * $row->counter);
				  $data['counter'] = $expiry . ' ' . Lang::$word->_DAYS;
	
				  $current_time = time();
				  $expiry_time = $row->file_date + ($expiry * 24 * 60 * 60);
				  $remaining_time = ceil(($expiry_time - time()) / (24 * 60 * 60));
				  $elapsed_time = $current_time - $row->file_date;
	
				  if ($current_time > $expiry_time) {
					  $data['status'] = '<div class="label2 nomg label-important">' . Lang::$word->FM_ERROR1 . '</div>';
					  $bar_width = 100;
					  $data['expired'] = true;
				  } else {
					  $data['status'] = str_replace("[DAYS]", $remaining_time, Lang::$word->FM_ERROR2);
					  $bar_width = round((($elapsed_time / ($expiry * 24 * 60 * 60)) * 100), 0);
				  }
	
				  $tbar = ($bar_width > 100) ? 100 : $bar_width;
				  $data['bar'] = $tbar;
			  } else {
				  $expiry = $row->expiry * $row->counter;
				  $data['counter'] = $expiry . ' ' . Lang::$word->DOWNLOADS;
	
				  $remaining_downloads = $expiry - $row->file_downloads;
	
				  if ($row->file_downloads >= ($row->expiry * $row->counter)) {
					  $data['status'] = '<div class="label2 nomg label-important">' . Lang::$word->FM_ERROR1 . '</div>';
					  $data['expired'] = true;
				  } else {
					  $data['status'] = str_replace("[DOWNS]", $remaining_downloads, Lang::$word->FM_ERROR3);
				  }
	
				  $bar_width = round(($row->file_downloads / ($row->expiry * $row->counter) * 100), 0);
				  $data['bar'] = $bar_width;
			  }
		  } else {
			  if ($row->status == 1) {
				  $data['status'] = '<div class="label2 nomg label-success">' . Lang::$word->FM_ERROR4 . '</div>';
			  } else {
				  $data['expiry'] = 0;
				  $data['status'] = '<div class="label2 nomg label-warning">' . Lang::$word->FM_ERROR5 . '</div>';
			  }
		  }
		  
		  return $data;
	
	  }
	  
      /**
       * Stats::doArraySum($array, $key)
       * 
	   * @param array $array
	   * @param string $key
       * @return
       */
      public static function doArraySum($array, $key)
      {
		  if (is_array($array)) {
			  return (number_format(array_sum(array_map(function ($item) use ($key){return $item->$key;}
			  , $array)),2));
		  }
	
		  return 0;
		  
	  }
 }