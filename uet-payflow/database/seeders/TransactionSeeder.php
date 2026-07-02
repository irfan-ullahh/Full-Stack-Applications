<?php

// database/seeders/TransactionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all user IDs (except SYSTEM account id=1 for receiver)
        $users = DB::table('users')->where('id', '!=', 1)->pluck('id')->toArray();
        
        if (empty($users)) {
            $this->command->info('No users found. Run UserSeeder first.');
            return;
        }

        // 1. Create DEPOSIT transactions (SYSTEM to students)
        $deposits = [
            ['user_id' => 2, 'amount' => 5000.00],   // BF25PwCS1700
            ['user_id' => 3, 'amount' => 3000.00],   // BF25PwCS1532
            ['user_id' => 4, 'amount' => 2500.00],   // BF25PwCS1001
            ['user_id' => 5, 'amount' => 4200.00],   // BF25PwCS1002
            ['user_id' => 6, 'amount' => 1800.00],   // BF25PwCS1003
            ['user_id' => 7, 'amount' => 6200.00],   // BF25PwCS1004
            ['user_id' => 8, 'amount' => 3500.00],   // BF25PwCS1005
            ['user_id' => 9, 'amount' => 2800.00],   // BF25PwCS1006
            ['user_id' => 10, 'amount' => 4500.00],  // BF25PwCS1007
            ['user_id' => 11, 'amount' => 3900.00],  // BF25PwCS1008
        ];

        foreach ($deposits as $deposit) {
            DB::table('transactions')->insert([
                'sender_id' => 1,  // SYSTEM account
                'receiver_id' => $deposit['user_id'],
                'type' => 'deposit',
                'amount' => $deposit['amount'],
                'status' => 'success',
                'failure_reason' => null,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);
        }

        // 2. Create TRANSFER transactions (student to student)
        $transfers = [
            // From Irfan to Ishaq
            [
                'from_user' => 2,   // BF25PwCS1700 (Irfan)
                'to_user' => 3,     // BF25PwCS1532 (Ishaq)
                'amount' => 500.00,
                'days_ago' => 25
            ],
            [
                'from_user' => 2,
                'to_user' => 3,
                'amount' => 200.00,
                'days_ago' => 20
            ],
            // From Ishaq to Ali
            [
                'from_user' => 3,
                'to_user' => 4,     // BF25PwCS1001 (Ali)
                'amount' => 300.00,
                'days_ago' => 18
            ],
            // From Fatima to Ahmed
            [
                'from_user' => 5,   // BF25PwCS1002 (Fatima)
                'to_user' => 6,     // BF25PwCS1003 (Ahmed)
                'amount' => 150.00,
                'days_ago' => 15
            ],
            // From Sara to Usman
            [
                'from_user' => 7,   // BF25PwCS1004 (Sara)
                'to_user' => 8,     // BF25PwCS1005 (Usman)
                'amount' => 400.00,
                'days_ago' => 12
            ],
            // From Ayesha to Bilal
            [
                'from_user' => 9,   // BF25PwCS1006 (Ayesha)
                'to_user' => 10,    // BF25PwCS1007 (Bilal)
                'amount' => 250.00,
                'days_ago' => 10
            ],
            // From Hina to Omar
            [
                'from_user' => 11,  // BF25PwCS1008 (Hina)
                'to_user' => 12,    // BF25PwCS1009 (Omar)
                'amount' => 350.00,
                'days_ago' => 8
            ],
            // Multiple transfers between same users
            [
                'from_user' => 2,
                'to_user' => 4,
                'amount' => 100.00,
                'days_ago' => 5
            ],
            [
                'from_user' => 3,
                'to_user' => 5,
                'amount' => 200.00,
                'days_ago' => 3
            ],
            [
                'from_user' => 4,
                'to_user' => 6,
                'amount' => 75.00,
                'days_ago' => 2
            ],
            [
                'from_user' => 5,
                'to_user' => 7,
                'amount' => 180.00,
                'days_ago' => 1
            ],
        ];

        foreach ($transfers as $transfer) {
            DB::table('transactions')->insert([
                'sender_id' => $transfer['from_user'],
                'receiver_id' => $transfer['to_user'],
                'type' => 'transfer',
                'amount' => $transfer['amount'],
                'status' => 'success',
                'failure_reason' => null,
                'created_at' => now()->subDays($transfer['days_ago']),
                'updated_at' => now(),
            ]);
        }

        // 3. Create some FAILED transactions for testing
        $failedTransactions = [
            [
                'from_user' => 2,
                'to_user' => 3,
                'amount' => 10000.00,  // Insufficient balance
                'reason' => 'Insufficient balance',
                'days_ago' => 14
            ],
            [
                'from_user' => 3,
                'to_user' => 2,
                'amount' => 5000.00,   // Insufficient balance
                'reason' => 'Insufficient balance',
                'days_ago' => 10
            ],
            [
                'from_user' => 4,
                'to_user' => 5,
                'amount' => 9999.00,   // Insufficient balance
                'reason' => 'Insufficient balance',
                'days_ago' => 7
            ],
        ];

        foreach ($failedTransactions as $failed) {
            DB::table('transactions')->insert([
                'sender_id' => $failed['from_user'],
                'receiver_id' => $failed['to_user'],
                'type' => 'transfer',
                'amount' => $failed['amount'],
                'status' => 'failed',
                'failure_reason' => $failed['reason'],
                'created_at' => now()->subDays($failed['days_ago']),
                'updated_at' => now(),
            ]);
        }

        // 4. Generate 50+ random transfers for more data
        $this->command->info('Generating additional random transactions...');
        
        for ($i = 0; $i < 50; $i++) {
            $randomSender = $users[array_rand($users)];
            $randomReceiver = $users[array_rand($users)];
            
            // Ensure sender and receiver are different
            while ($randomSender === $randomReceiver) {
                $randomReceiver = $users[array_rand($users)];
            }
            
            $randomAmount = rand(50, 1000);
            $randomDaysAgo = rand(1, 60);
            $randomStatus = rand(1, 10) > 8 ? 'failed' : 'success'; // 20% failed rate
            
            DB::table('transactions')->insert([
                'sender_id' => $randomSender,
                'receiver_id' => $randomReceiver,
                'type' => 'transfer',
                'amount' => $randomAmount,
                'status' => $randomStatus,
                'failure_reason' => $randomStatus === 'failed' ? 'Random simulated failure' : null,
                'created_at' => now()->subDays($randomDaysAgo),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Transaction seeding completed!');
        $this->command->info('Total transactions: ' . DB::table('transactions')->count());
    }
}