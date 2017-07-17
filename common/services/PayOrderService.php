<?php 

namespace app\common\services;

use app\common\services\BaseService;

use app\models\PayOrder;
 
// 图书库存变更服务
class PayOrderService  extends BaseService
{

	/**
	 * 下单方法
	 * 
	 * $items = [
	 * 		['target_id','target_type','price','goodsnum']
	 * ]
	 * 
	 * @return	bool
	 */
	public static function createPayOrder( $member_id, $items = [], $params = [] )
	{
		$total_price = 0;

		$continue_cnt = 0;

		foreach( $items as $_item )
		{
			if( $_item['price'] < 0 )
			{
				continue;
			}

			$total_price += $_item['price'];
		}

		if( $continue_cnt <= count( $items ) )
		{
			return self::__err( '商品items为空' );
		}

		// 优惠金额
		$discount = isset( $params['discount'] ) ? $params['discount'] : 0 ;

		$total_price = sprintf( '%0.2f', $total_price );
		$discount 	 = sprintf( '%0.2f', $discount );

		// 支付金额
		$pay_price   = $total_price - $discount;
		$pay_price 	 = sprintf( '%0.2f', $pay_price );
 		
 		$time        = date( 'Y-m-d H:i:s');

 		$connection  = PayOrder::getDb(); 

 		$transation  = $connection->beginTransation();

 		try{

 			// 并发控制

 			$tmp_book_table_name = Book::tableName();

 			$tmp_book_ids = array_column( $items, 'target_id' );

 			$tmp_sql = "SELECT `id`,`stock` FROM book where ids in( ".implode(',', $tmp_book_id)." ) ";

 			


 		}catch( Exception  $e ){

 			$transation->rollback();
 			
 			return self::__err( $e->getMessage() );
 		}


	}	


	public static function getDb()
	{

	}



}



 ?>