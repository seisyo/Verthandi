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

        Account::create([
            'id' => 10000,
            'name' => '資產',
            'parent_id' => null,
            'direction' => true
        ]);
        Account::create([
            'id' => 11000,
            'name' => '流動資產',
            'parent_id' => 10000,
            'direction' => true
        ]);
        Account::create([
            'id' => 12000,
            'name' => '流動資產',
            'parent_id' => 10000,
            'direction' => true
        ]);
        Account::create([
            'id' => 11100,
            'name' => '現金及約當現金',
            'parent_id' => 11000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 11110,
            'name' => '庫存現金',
            'parent_id' => 11100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 11120,
            'name' => '零用金',
            'parent_id' => 11100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 11130,
            'name' => '銀行存款',
            'parent_id' => 11100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 11131,
            'name' => '銀行存款-OCF',
            'parent_id' => 11130,
            'direction' => true,
        ]);
        Account::create([
            'id' => 11132,
            'name' => '銀行存款-科斯高',
            'parent_id' => 11130,
            'direction' => true,
        ]);
        Account::create([
            'id' => 11133,
            'name' => '銀行存款-SITCON',
            'parent_id' => 11130,
            'direction' => true,
        ]);
        Account::create([
            'id' => 12100,
            'name' => '存貨',
            'parent_id' => 12000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 12110,
            'name' => '商品存貨',
            'parent_id' => 12000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 12120,
            'name' => '贈品存貨',
            'parent_id' => 12100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 12500,
            'name' => '預付費用',
            'parent_id' => 12000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 12600,
            'name' => '預付款項',
            'parent_id' => 12000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 12610,
            'name' => '預付貨款',
            'parent_id' => 12600,
            'direction' => true,
        ]);
        Account::create([
            'id' => 12800,
            'name' => '其他流動資產',
            'parent_id' => 12000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 12840,
            'name' => '代付款',
            'parent_id' => 12800,
            'direction' => true,
        ]);
        Account::create([
            'id' => 20000,
            'name' => '負債',
            'parent_id' => null,
            'direction' => false,
        ]);
        Account::create([
            'id' => 21000,
            'name' => '流動負債',
            'parent_id' => 20000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 22000,
            'name' => '流動負債',
            'parent_id' => 20000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 21100,
            'name' => '短期借款',
            'parent_id' => 21000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 21170,
            'name' => '短期借款-關係人',
            'parent_id' => 21100,
            'direction' => false,
        ]);
        Account::create([
            'id' => 21400,
            'name' => '應付帳款',
            'parent_id' => 21000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 21410,
            'name' => '應付帳款',
            'parent_id' => 21400,
            'direction' => false,
        ]);
        Account::create([
            'id' => 21800,
            'name' => '其他應付款',
            'parent_id' => 21000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 21900,
            'name' => '其他應付款',
            'parent_id' => 21000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 21870,
            'name' => '其他應付款-關係人',
            'parent_id' => 21800,
            'direction' => false,
        ]);
        Account::create([
            'id' => 22600,
            'name' => '預收款項',
            'parent_id' => 22000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 22620,
            'name' => '預收收入',
            'parent_id' => 22600,
            'direction' => false,
        ]);
        Account::create([
            'id' => 22621,
            'name' => '預收捐贈收入',
            'parent_id' => 22620,
            'direction' => false,
        ]);
        Account::create([
            'id' => 22800,
            'name' => '其他流動負債',
            'parent_id' => 22000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 22900,
            'name' => '其他流動負債',
            'parent_id' => 22000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 22840,
            'name' => '代收款',
            'parent_id' => 22800,
            'direction' => false,
        ]);
        Account::create([
            'id' => 22890,
            'name' => '估計應付贈品',
            'parent_id' => 22800,
            'direction' => false,
        ]);
        Account::create([
            'id' => 30000,
            'name' => '餘絀',
            'parent_id' => null,
            'direction' => false,
        ]);
        Account::create([
            'id' => 33000,
            'name' => '保留盈餘',
            'parent_id' => 30000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 33500,
            'name' => '累積盈虧',
            'parent_id' => 33000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 33510,
            'name' => '累積盈虧',
            'parent_id' => 33500,
            'direction' => false,
        ]);
        Account::create([
            'id' => 33520,
            'name' => '前期損益調整',
            'parent_id' => 33500,
            'direction' => false,
        ]);
        Account::create([
            'id' => 33530,
            'name' => '本期損益',
            'parent_id' => 33500,
            'direction' => false,
        ]);
        Account::create([
            'id' => 40000,
            'name' => '收益',
            'parent_id' => null,
            'direction' => false,
        ]);
        Account::create([
            'id' => 41000,
            'name' => '銷貨收入',
            'parent_id' => 40000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 41100,
            'name' => '銷貨收入',
            'parent_id' => 41000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 41110,
            'name' => '銷貨收入',
            'parent_id' => 41100,
            'direction' => false,
        ]);
        Account::create([
            'id' => 41700,
            'name' => '銷貨退回',
            'parent_id' => 41000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 41710,
            'name' => '銷貨退回',
            'parent_id' => 41700,
            'direction' => false,
        ]);
        Account::create([
            'id' => 41900,
            'name' => '銷貨折讓',
            'parent_id' => 41000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 41910,
            'name' => '銷貨折讓',
            'parent_id' => 41900,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48000,
            'name' => '其他收入',
            'parent_id' => 40000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48100,
            'name' => '捐贈收入',
            'parent_id' => 48000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48110,
            'name' => '個人捐贈收入',
            'parent_id' => 48100,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48120,
            'name' => '團體捐贈收入',
            'parent_id' => 48100,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48130,
            'name' => '公家機關捐贈收入',
            'parent_id' => 48100,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48140,
            'name' => '企業捐贈收入',
            'parent_id' => 48100,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48200,
            'name' => '贊助收入',
            'parent_id' => 48000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48210,
            'name' => '企業贊助收入',
            'parent_id' => 48200,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48300,
            'name' => '利息收入',
            'parent_id' => 48000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48310,
            'name' => '利息收入',
            'parent_id' => 48300,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48400,
            'name' => '現金短溢',
            'parent_id' => 48000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48410,
            'name' => '現金短溢',
            'parent_id' => 48400,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48500,
            'name' => '其他收入',
            'parent_id' => 48000,
            'direction' => false,
        ]);
        Account::create([
            'id' => 48510,
            'name' => '其他收入',
            'parent_id' => 48500,
            'direction' => false,
        ]);
        Account::create([
            'id' => 50000,
            'name' => '費損',
            'parent_id' => null,
            'direction' => true,
        ]);
        Account::create([
            'id' => 51000,
            'name' => '銷貨成本',
            'parent_id' => 50000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 51100,
            'name' => '銷貨成本',
            'parent_id' => 51000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 51110,
            'name' => '銷貨成本',
            'parent_id' => 51100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52000,
            'name' => '營運費用',
            'parent_id' => 50000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53000,
            'name' => '營運費用',
            'parent_id' => 50000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52100,
            'name' => '租金費用',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52110,
            'name' => '租金費用-設備',
            'parent_id' => 52100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52120,
            'name' => '租金費用-場地',
            'parent_id' => 52100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52130,
            'name' => '租金費用-接駁車',
            'parent_id' => 52100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52200,
            'name' => '文具用品',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52210,
            'name' => '文具用品',
            'parent_id' => 52200,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52300,
            'name' => '住宿費',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52310,
            'name' => '住宿費',
            'parent_id' => 52300,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52400,
            'name' => '交通費',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52410,
            'name' => '交通費',
            'parent_id' => 52400,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52500,
            'name' => '運費',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52510,
            'name' => '運費',
            'parent_id' => 52500,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52600,
            'name' => '郵電費',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52610,
            'name' => '郵電費',
            'parent_id' => 52600,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52700,
            'name' => '廣告費',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52710,
            'name' => '廣告費',
            'parent_id' => 52700,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52800,
            'name' => '匯款手續費',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52810,
            'name' => '匯款手續費',
            'parent_id' => 52800,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52900,
            'name' => '服務手續費',
            'parent_id' => 52000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 52910,
            'name' => '服務手續費',
            'parent_id' => 52900,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53100,
            'name' => '保險費',
            'parent_id' => 53000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53110,
            'name' => '保險費',
            'parent_id' => 53100,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53200,
            'name' => '勞務費',
            'parent_id' => 53000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53210,
            'name' => '勞務費',
            'parent_id' => 53200,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53300,
            'name' => '餐飲費用',
            'parent_id' => 53000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53310,
            'name' => '餐飲費用',
            'parent_id' => 53300,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53400,
            'name' => '志工福利',
            'parent_id' => 53000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53410,
            'name' => '志工福利',
            'parent_id' => 53400,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53500,
            'name' => '利息費用',
            'parent_id' => 53000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53510,
            'name' => '利息費用',
            'parent_id' => 53500,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53600,
            'name' => '交際費',
            'parent_id' => 53000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53610,
            'name' => '交際費',
            'parent_id' => 53600,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53700,
            'name' => '贈品費用',
            'parent_id' => 53000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53710,
            'name' => '贈品費用',
            'parent_id' => 53700,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53800,
            'name' => '網路服務費用',
            'parent_id' => 53000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 53810,
            'name' => '網路服務費用',
            'parent_id' => 53800,
            'direction' => true,
        ]);
        Account::create([
            'id' => 58000,
            'name' => '其他費用',
            'parent_id' => 50000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 58100,
            'name' => '其他費用',
            'parent_id' => 58000,
            'direction' => true,
        ]);
        Account::create([
            'id' => 58110,
            'name' => '現金短溢',
            'parent_id' => 58100,
            'direction' => true,
        ]);



    }
}
