<?php

namespace Tests\Feature;

use App\Models\Auteur;
use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\Statut;
use App\Models\Usager;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BibliotekFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_visiteur_est_redirige_vers_la_connexion(): void
    {
        $response = $this->get('/livres');

        $response->assertRedirect('/connexion');
        $this->assertGuest();
    }

    public function test_un_admin_peut_creer_un_emprunt(): void
    {
        $admin = User::factory()->create();

        $statutDisponible = Statut::create([
            'statut' => 'disponible',
        ]);

        Statut::create([
            'statut' => 'emprunté',
        ]);

        $auteur = Auteur::create([
            'nom' => 'Victor Hugo',
        ]);

        $livre = Livre::create([
            'titre' => 'Les Misérables',
            'auteur_id' => $auteur->id,
        ]);

        $exemplaire = $livre->exemplaires()->create([
            'mise_en_service' => now()->toDateString(),
            'statut_id' => $statutDisponible->id,
        ]);

        $usager = Usager::create([
            'email' => '[email protected]',
            'mdp' => bcrypt('password123'),
        ]);

        $response = $this->actingAs($admin)->post('/emprunts', [
            'usager_id' => $usager->id,
            'livre_id' => $livre->id,
        ]);

        $response->assertRedirect('/livres');

        $this->assertDatabaseCount('emprunts', 1);

        $this->assertDatabaseHas('emprunts', [
            'usager_id' => $usager->id,
            'exemplaire_id' => $exemplaire->id,
        ]);

        $this->assertDatabaseHas('exemplaires', [
            'id' => $exemplaire->id,
            'statut_id' => 2,
        ]);
    }

    public function test_un_admin_peut_enregistrer_un_retour(): void
    {
        $admin = User::factory()->create();

        Statut::create([
            'id' => 1,
            'statut' => 'disponible',
        ]);

        Statut::create([
            'id' => 2,
            'statut' => 'emprunté',
        ]);

        $auteur = Auteur::create([
            'nom' => 'Albert Camus',
        ]);

        $livre = Livre::create([
            'titre' => 'L’Étranger',
            'auteur_id' => $auteur->id,
        ]);

        $exemplaire = $livre->exemplaires()->create([
            'mise_en_service' => now()->toDateString(),
            'statut_id' => 2,
        ]);

        $usager = Usager::create([
            'email' => '[email protected]',
            'mdp' => bcrypt('password123'),
        ]);

        $emprunt = Emprunt::create([
            'date_emprunt' => now()->subDays(5),
            'date_retour_prevue' => now()->addDays(25),
            'date_retour' => null,
            'usager_id' => $usager->id,
            'exemplaire_id' => $exemplaire->id,
        ]);

        $response = $this->actingAs($admin)->patch('/retours/' . $emprunt->id);

        $response->assertRedirect('/retours');

        $this->assertDatabaseHas('emprunts', [
            'id' => $emprunt->id,
            'exemplaire_id' => $exemplaire->id,
        ]);

        $this->assertDatabaseMissing('emprunts', [
            'id' => $emprunt->id,
            'date_retour' => null,
        ]);

        $this->assertDatabaseHas('exemplaires', [
            'id' => $exemplaire->id,
            'statut_id' => 1,
        ]);
    }
}
