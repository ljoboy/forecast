<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'../vendor/fzaninotto/faker/src/autoload.php';
class Faker extends CI_Controller {

	public function agent()
	{
        $this->load->model('Agent_model');
        $faker = Faker\Factory::create();

        for ($i=0;$i<250;$i++){
            $d = $faker->dateTimeInInterval($startDate = '-10 years', $interval = '+ 30 days', $timezone = null);
            $d2 = $d->add(new DateInterval('P2Y4DT6H8M'));
            $d1 = $faker->dateTimeInInterval($startDate = '-30 years', $interval = '-18 years', $timezone = null);
            $data = array(
                'nom' => $faker->lastName,
                'postnom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'etat_civil' => $faker->randomElement($array = array ('marié', 'célibataire', 'réligieux')),
                'matricule' => $faker->swiftBicNumber,
                'adresse' => $faker->address,
                'email' => $faker->email,
                'date_de_naissance' => $d1->format('Y-m-d'),
                'lieu_de_naissance' => $faker->city,
                'telephone' => $faker->e164PhoneNumber,
                'genre' => $faker->randomElement($array = array ('m', 'f')),
                'date_entree' => $d->format('Y-m-d'),
                'date_confirmation' => $d2->format('Y-m-d'),
                'ville' => $faker->city,
                'province' => $faker->city,
                'pays' => $faker->country,
                'departement_id_departement' => $faker->randomElement($array = array (1, 2, 3, 4)),
            );

            $this->Agent_model->insert($data);
        }
        echo "c'est bon";
	}

    public function langues()
    {
        $faker = Faker\Factory::create();

        $this->load->model('Agent_model');
        $this->load->model('Langage_model');
        $this->load->model('Connaissances_linguistiques_model');

        $agents = $this->Agent_model->get_all();
        foreach ($agents as $agent) {
            for ($i = 0; $i < $faker->numberBetween($min = 1, $max = 3); $i++){
                $lang = $this->Langage_model->get_by_id($faker->numberBetween($min = 1, $max = 430));
                $data = array(
                    'lecture' => $faker->randomDigitNotNull,
                    'ecriture' => $faker->randomDigitNotNull,
                    'parler' => $faker->randomDigitNotNull,
                    'comprendre' => $faker->randomDigitNotNull,
                    'agent_id_agent' => $agent->id_agent,
                    'langage_id_langage' => $lang->id_langage
                );
                $this->Connaissances_linguistiques_model->insert($data);
            }
        }

	}

    public function taches()
    {
        $faker = Faker\Factory::create('en_US');
        $this->load->model('Tache_model');
        for ($i=0;$i<150;$i++){
            $d = Faker\Provider\DateTime::dateTimeBetween($startDate = '-30 days', $endDate = 'now', $timezone = null);
            $data = array(
                'tache' => $faker->realText($maxNbChars = 50, $indexSize = 2) ,
                'date_debut' => $d->format('Y-m-d'),
                'details' => $faker->realText($maxNbChars = 500, $indexSize = 5) ,
            );
            $d->add(new DateInterval($faker->numerify('P0Y##DT#H#M')));
            $data['date_fin'] = $d->format('Y-m-d');
            $this->Tache_model->insert($data);
        }
	}

    public function categories()
    {
        $this->load->model('Categorie_materiel_model');
        $faker = Faker\Factory::create('fr_FR');
        for ($i=0;$i<50;$i++){
            $d = $faker->dateTimeBetween($startDate = '-8 days', $endDate = 'now');
            $data = array(
                'nom_cat_mat' => $faker->realText($maxNbChars = 20, $indexSize = 1),
                'date_creation_cat' => $d->format('Y-m-d H:i:s'),
                'details_cat_ma' => $faker->realText($maxNbChars = 200, $indexSize = 4),
            );
            $this->Categorie_materiel_model->insert($data);
        }
	}

    public function fournisseurs()
    {
        $this->load->model('Fournisseur_model');
        $faker = Faker\Factory::create('fr_FR');
        for ($i=0;$i<10;$i++){
            $d = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now');
            $data = array(
                'reference_fornisseur' => $faker->company,
                'adresse_fournissseur' => $faker->address,
                'email_fournisseur' => $faker->companyEmail,
                'date_creation_fournisseur' => $d->format('Y-m-d H:i:s'),
            );
            $this->Fournisseur_model->insert($data);
        }



	}

    public function matos()
    {
        $this->load->model('Materiel_model');
        $faker = Faker\Factory::create('fr_FR');
        for ($i=0;$i<50;$i++){
            $data = array(
                'designation_materiel' => $faker->name,
                'quantite_stock' => $faker->randomNumber($nbDigits = 4),
                'stock_min' => $faker->numerify('##'),
                'details' => $faker->realText($maxNbChars = 250, $indexSize = 2),
                'fournisseur_id_fournisseur' => $faker->randomElement($array = range(3,12)),
                'categorie_materiel_id_cat_mat' =>  $faker->randomElement($array = range(101,150)),
            );
            $this->Materiel_model->insert($data);
        }

	}

    public function etude_level()
    {
        $this->load->model('Agent_model');
        $agents = $this->Agent_model->get_all();
        $faker = Faker\Factory::create('fr_FR');
        foreach ($agents as $agent) {
            $data = array(
                'etude_level' => $faker->realText($maxNbChars = 20, $indexSize = 1)
            );
            $this->Agent_model->update($agent->id_agent, $data);
        }

	}

    public function tache_dep()
    {
        $this->load->model('Tache_model');
        $taches = $this->Tache_model->get_all();
        foreach ($taches as $tache) {
            $data = array('departement_id_departement'=>Faker\Provider\Biased::randomElement($array = array(1,2,3,4)));
            $this->Tache_model->update($tache->id_tache, $data);
        }
	}

}

/* End of file Faker.php */
