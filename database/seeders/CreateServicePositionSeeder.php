<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateServicePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Service
        $service = Service::create([
            'service_name' => 'Service Informatique',
        ]);
        
        // Create position
        $position = Position::create([
            'position_name' => 'Directeur du Système d\'Information',
            'service_id' => $service->id,
        ]);
        
        // Create position
        $position = Position::create([
            'position_name' => 'Administrateur Système',
            'service_id' => $service->id,
        ]);
        
        // Create position
        $position = Position::create([
            'position_name' => 'Développeur',
            'service_id' => $service->id,
        ]);
        
        // Create Service
        $service = Service::create([
            'service_name' => 'Ressources Humaines',
        ]);
        
        // Create position
        $position = Position::create([
            'position_name' => 'Directeur des Ressources Humaines',
            'service_id' => $service->id,
        ]);
        
        // Create position
        $position = Position::create([
            'position_name' => 'Responsable des Ressources Humaines',
            'service_id' => $service->id,
        ]);
        
        // Create Service
        $service = Service::create([
            'service_name' => 'Service Comercial',
        ]);
        
        // Create position
        $position = Position::create([
            'position_name' => 'Directeur Comercial',
            'service_id' => $service->id,
        ]);
        
        // Create position
        $position = Position::create([
            'position_name' => 'Responsable Comercial',
            'service_id' => $service->id,
        ]);
    }
}
