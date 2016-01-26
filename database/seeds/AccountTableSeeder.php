<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Account;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account')->delete();

        $data = [
            [
                'id' => 0,
                'name' => '父科目',
                'parent_id' => 0,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '資產',
                'parent_id' => 0,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '流動資產',
                'parent_id' => 1,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '流動資產',
                'parent_id' => 1,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '現金及約當現金',
                'parent_id' => 11,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '庫存現金',
                'parent_id' => 111,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '零用金',
                'parent_id' => 111,
                'direction' => true
            ],
            [
                'id' => 3,
                'name' => '銀行存款',
                'parent_id' => 111,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '銀行存款-OCF',
                'parent_id' => 1113,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '銀行存款-科斯高',
                'parent_id' => 1113,
                'direction' => true
            ],
            [
                'id' => 3,
                'name' => '銀行存款-SITCON',
                'parent_id' => 1113,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '存貨',
                'parent_id' => 12,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '商品存貨',
                'parent_id' => 121,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '贈品存貨',
                'parent_id' => 121,
                'direction' => true
            ],
            [
                'id' => 5,
                'name' => '預付費用',
                'parent_id' => 12,
                'direction' => true
            ],
            [
                'id' => 6,
                'name' => '預付款項',
                'parent_id' => 12,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '預付貨款',
                'parent_id' => 126,
                'direction' => true
            ],
            [
                'id' => 8,
                'name' => '其他流動資產',
                'parent_id' => 12,
                'direction' => true
            ],
            [
                'id' => 4,
                'name' => '代付款',
                'parent_id' => 128,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '負債',
                'parent_id' => 0,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '流動負債',
                'parent_id' => 2,
                'direction' => false
            ],
            [
                'id' => 2,
                'name' => '流動負債',
                'parent_id' => 2,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '短期借款',
                'parent_id' => 21,
                'direction' => false  
            ],
            [
                'id' => 7,
                'name' => '短期借款-關係人',
                'parent_id' => 211,
                'direction' => false
            ],
            [
                'id' => 4,
                'name' => '應付帳款',
                'parent_id' => 21,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '應付帳款',
                'parent_id' => 214,
                'direction' => false
            ],
            [
                'id' => 8,
                'name' => '其他應付款',
                'parent_id' => 21,
                'direction' => false
            ],
            [
                'id' => 9,
                'name' => '其他應付款',
                'parent_id' => 21,
                'direction' => false
            ],
            [
                'id' => 7,
                'name' => '其他應付款-關係人',
                'parent_id' => 218,
                'direction' => false
            ],
            [
                'id' => 6,
                'name' => '預收款項',
                'parent_id' => 22,
                'direction' => false
            ],
            [
                'id' => 2,
                'name' => '預收收入',
                'parent_id' => 226,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '預收捐贈收入',
                'parent_id' => 2262,
                'direction' => false
            ],
            [
                'id' => 8,
                'name' => '其他流動負債',
                'parent_id' => 22,
                'direction' => false
            ],
            [
                'id' => 9,
                'name' => '其他流動負債',
                'parent_id' => 22,
                'direction' => false
            ],
            [
                'id' => 4,
                'name' => '代收款',
                'parent_id' => 228,
                'direction' => false
            ],
            [
                'id' => 9,
                'name' => '估計應付贈品',
                'parent_id' => 228,
                'direction' => false
            ],
            [
                'id' => 3,
                'name' => '餘絀',
                'parent_id' => 0,
                'direction' => false
            ],
            [
                'id' => 3,
                'name' => '保留盈餘',
                'parent_id' => 3,
                'direction' => false
            ],
            [
                'id' => 5,
                'name' => '累積盈虧',
                'parent_id' => 33,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '累積盈虧',
                'parent_id' => 335,
                'direction' => false
            ],
            [
                'id' => 2,
                'name' => '前期損益調整',
                'parent_id' => 335,
                'direction' => false
            ],
            [
                'id' => 3,
                'name' => '本期損益',
                'parent_id' => 335,
                'direction' => false
            ],
            [
                'id' => 4,
                'name' => '收益',
                'parent_id' => 0,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '銷貨收入',
                'parent_id' => 4,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '銷貨收入',
                'parent_id' => 41,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '銷貨收入',
                'parent_id' => 411,
                'direction' => false
            ],
            [
                'id' => 7,
                'name' => '銷貨退回',
                'parent_id' => 41,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '銷貨退回',
                'parent_id' => 417,
                'direction' => false
            ],
            [
                'id' => 9,
                'name' => '銷貨折讓',
                'parent_id' => 41,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '銷貨折讓',
                'parent_id' => 419,
                'direction' => false
            ],
            [
                'id' => 8,
                'name' => '其他收入',
                'parent_id' => 4,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '捐贈收入',
                'parent_id' => 48,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '個人捐贈收入',
                'parent_id' => 481,
                'direction' => false
            ],
            [
                'id' => 2,
                'name' => '團體捐贈收入',
                'parent_id' => 481,
                'direction' => false
            ],
            [
                'id' => 3,
                'name' => '公家機關捐贈收入',
                'parent_id' => 481,
                'direction' => false
            ],
            [
                'id' => 4,
                'name' => '企業捐贈收入',
                'parent_id' => 481,
                'direction' => false
            ],
            [
                'id' => 2,
                'name' => '贊助收入',
                'parent_id' => 48,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '企業贊助收入',
                'parent_id' => 482,
                'direction' => false
            ],
            [
                'id' => 3,
                'name' => '利息收入',
                'parent_id' => 48,
                'direction' => false    
            ],
            [
                'id' => 1,
                'name' => '利息收入',
                'parent_id' => 483,
                'direction' => false
            ],
            [
                'id' => 4,
                'name' => '現金短溢',
                'parent_id' => 48,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '現金短溢',
                'parent_id' => 484,
                'direction' => false
            ],
            [
                'id' => 5,
                'name' => '其他收入',
                'parent_id' => 48,
                'direction' => false
            ],
            [
                'id' => 1,
                'name' => '其他收入',
                'parent_id' => 485,
                'direction' => false
            ],
            [
                'id' => 5,
                'name' => '費損',
                'parent_id' => 0,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '銷貨成本',
                'parent_id' => 5,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '銷貨成本',
                'parent_id' => 51,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '銷貨成本',
                'parent_id' => 511,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '營運費用',
                'parent_id' => 5,
                'direction' => true
            ],
            [
                'id' => 3,
                'name' => '營運費用',
                'parent_id' => 5,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '租金費用',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '租金費用-設備',
                'parent_id' => 521,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '租金費用-場地',
                'parent_id' => 521,
                'direction' => true
            ],
            [
                'id' => 3,
                'name' => '租金費用-接駁車',
                'parent_id' => 521,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '文具用品',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '文具用品',
                'parent_id' => 522,
                'direction' => true
            ],
            [
                'id' => 3,
                'name' => '住宿費',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '住宿費',
                'parent_id' => 523,
                'direction' => true
            ],
            [
                'id' => 4,
                'name' => '交通費',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '交通費',
                'parent_id' => 524,
                'direction' => true    
            ],
            [
                'id' => 5,
                'name' => '運費',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '運費',
                'parent_id' => 525,
                'direction' => true
            ],
            [
                'id' => 6,
                'name' => '郵電費',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '郵電費',
                'parent_id' => 526,
                'direction' => true
            ],
            [
                'id' => 7,
                'name' => '廣告費',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '廣告費',
                'parent_id' => 527,
                'direction' => true
            ],
            [
                'id' => 8,
                'name' => '匯款手續費',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '匯款手續費',
                'parent_id' => 528,
                'direction' => true
            ],
            [
                'id' => 9,
                'name' => '服務手續費',
                'parent_id' => 52,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '服務手續費',
                'parent_id' => 529,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '保險費',
                'parent_id' => 53,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '保險費',
                'parent_id' => 531,
                'direction' => true
            ],
            [
                'id' => 2,
                'name' => '勞務費',
                'parent_id' => 53,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '勞務費',
                'parent_id' => 532,
                'direction' => true
            ],
            [
                'id' => 3,
                'name' => '餐飲費用',
                'parent_id' => 53,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '餐飲費用',
                'parent_id' => 533,
                'direction' => true
            ],
            [
                'id' => 4,
                'name' => '志工福利',
                'parent_id' => 53,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '志工福利',
                'parent_id' => 534,
                'direction' => true
            ],
            [
                'id' => 5,
                'name' => '利息費用',
                'parent_id' => 53,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '利息費用',
                'parent_id' => 535,
                'direction' => true
            ],
            [
                'id' => 6,
                'name' => '交際費',
                'parent_id' => 53,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '交際費',
                'parent_id' => 536,
                'direction' => true
            ],
            [
                'id' => 7,
                'name' => '贈品費用',
                'parent_id' => 53,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '贈品費用',
                'parent_id' => 537,
                'direction' => true
            ],
            [
                'id' => 8,
                'name' => '網路服務費用',
                'parent_id' => 53,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '網路服務費用',
                'parent_id' => 538,
                'direction' => true
            ],
            [
                'id' => 8,
                'name' => '其他費用',
                'parent_id' => 5,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '其他費用',
                'parent_id' => 58,
                'direction' => true
            ],
            [
                'id' => 1,
                'name' => '現金短溢',
                'parent_id' => 581,
                'direction' => true
            ]
        ];
       
        DB::table('account')->insert($data);
    }
}
