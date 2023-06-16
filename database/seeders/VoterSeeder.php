<?php

namespace Database\Seeders;

use App\Models\NadraDB;
use App\Models\User;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VoterSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$file = base_path('dummy_data/voter_data_for_testing - Sheet1 (2).csv');
		$row = 1;
		if (($handle = fopen($file, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 100, ",")) !== FALSE) {
				if ($row == 1) {
					$row++;
					continue;
				}
				$num = count($data);
				for ($c = 0; $c < 1; $c++) {
					$dateString = $data[5];
					$date = DateTime::createFromFormat('m/d/Y H:i', $dateString);
					$mysqlDate = $date->format('Y-m-d H:i:s');

					echo "<p>" . $data[0] . "</p>";
					NadraDB::create(
						[
							'cnic' => $data[0],
							'mother_name' => $data[4],
							'cnic_expiry_date' => $mysqlDate,
							'na_constituency_number' => $data[6],
							'pa_constituency_number' => $data[7],
							'name' => $data[3],
						],
					);
					User::create([
						'cnic' => $data[0],
						'email' => $data[1],
						'phone_number' => $data[2],
						'name' => $data[3],
						'password' => Hash::make($data[8]),
					]);
				}
				$row++;
			}
			fclose($handle);
			//

		}
	}
}
