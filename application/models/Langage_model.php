<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Langage_model extends CI_Model
{

    public $table = 'langage';
    public $id = 'id_langage';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_langage', $q);
	$this->db->or_like('nom_langage', $q);
	$this->db->or_like('description', $q);
	$this->db->or_like('connaissances_linguistiques_id_langue_parler', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_langage', $q);
	$this->db->or_like('nom_langage', $q);
	$this->db->or_like('description', $q);
	$this->db->or_like('connaissances_linguistiques_id_langue_parler', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->set('etat', 0);
        $this->db->where($this->id, $id);
        $this->db->update($this->table);
    }

    /*public function add()
    {
        $langs = ["Afrikaans",
			"Akan",
			"Albanais",
			"Amharique",
			"Arabe",
			"Arménien",
			"ASL (langue des signes américaine)",
			"Assamais",
			"Assyrien",
			"Azéri",
			"Badini",
			"Bambara",
			"Bashkir",
			"Basque",
			"Biélorusse",
			"Bengalais",
			"Bosniaque",
			"Bravanais",
			"Bulgare",
			"Birman",
			"Cambodgien",
			"Cantonais",
			"Catalan",
			"Cebuano",
			"Chaldean",
			"Chamorro",
			"Chaozhou",
			"Chavacano",
			"Chin",
			"Chuuk",
			"Cree",
			"Croate",
			"Tchèque",
			"Dakota",
			"Danois",
			"Dari",
			"Dinka",
			"Dioula",
			"Néerlandais",
			"Dzongkha",
			"Anglais",
			"Estonien",
			"Ewe",
			"Fanti",
			"Féroïen",
			"Farsi",
			"Hindi fidjien",
			"Finnois",
			"Flamand",
			"Français",
			"Français canadien",
			"Frison",
			"Fujian",
			"Fukienais",
			"Fula",
			"Fulani",
			"Fuzhou",
			"Ga",
			"Gaélique",
			"Galicien",
			"Ganda",
			"Géorgien",
			"Allemand",
			"Gorani",
			"Grec",
			"Gujarati",
			"Créole haïtien",
			"Hakka",
			"Hassanya",
			"Hausa",
			"Hébreu",
			"Hiligaïnon",
			"Hindi",
			"Hmong",
			"Hongrois",
			"Ibanag",
			"Islandais",
			"Igbo",
			"Ilocano",
			"Ilonggo",
			"Indien",
			"Indonésien",
			"Inuktitut",
			"Irlandais",
			"Italien",
			"Jakartanais",
			"Japonais",
			"Javanais",
			"Kanjobal",
			"Kannada",
			"Karen",
			"Cachemiri",
			"Kazakh",
			"Khalkha",
			"Khmer",
			"Kikuyu",
			"Kinyarwanda",
			"Kirundi",
			"Coréen",
			"Kosovar",
			"Kotokoli",
			"Krio",
			"Kurde",
			"Kurmanji",
			"Kirghize",
			"Lakota",
			"Laotien",
			"Latin",
			"Letton",
			"Lingala",
			"Lituanien",
			"Luganda",
			"Luo",
			"Lusoga",
			"Luxembourgeois",
			"Maay",
			"Macédonien",
			"Malgache",
			"Malais",
			"Malayalam",
			"Maldivien",
			"Maltais",
			"Mandarin",
			"Mandingue",
			"Mandinka",
			"Maori",
			"Marathi",
			"Marshallais",
			"Mien",
			"Mirpuri",
			"Mixtèque",
			"Moldave",
			"Mongol",
			"Navajo",
			"Napolitain",
			"Népalais",
			"Norvégien",
			"Nuer",
			"Nyanja",
			"Ojibaway",
			"Oriya",
			"Oromo",
			"Ossète",
			"Pahar",
			"Pampangan",
			"Pachtoune",
			"Patois",
			"Pidgin anglais",
			"Polonais",
			"Portugais",
			"Pothwari",
			"Peul",
			"Punjabi",
			"Puxian",
			"Guanxi",
			"Quechua",
			"Romani",
			"Roumain",
			"Romanche",
			"Rundi",
			"Russe",
			"Samoan",
			"Sango",
			"Sanskrit",
			"Serbe",
			"Shanghaïen",
			"Shona",
			"Sichuan",
			"Sicilien",
			"Sindhi",
			"Cingalais",
			"Cingalais",
			"Siswati/Swati",
			"Slovaque",
			"Slovène",
			"Slovène",
			"Somalien",
			"Soninké",
			"Sorani",
			"Sotho",
			"Espagnol",
			"Soundanais",
			"Susu",
			"Swahili",
			"Suédois",
			"Sylheti",
			"Tagalog",
			"Taïwanais",
			"Tadjik",
			"Tamoul",
			"Telugu",
			"Thaï",
			"Tibétain",
			"Tigrinya",
			"Tongan",
			"Tshiluba",
			"Tsonga",
			"Tswana",
			"Turc",
			"Turkmène",
			"Ouïghour",
			"Ukrainien",
			"Ourdou",
			"Ouzbek",
			"Venda",
			"Vietnamien",
			"Visayan",
			"Gallois",
			"Wolof",
			"Xhosa",
			"Yao",
			"Yiddish",
			"Yoruba",
			"Yupik",
			"Zoulou"];
        foreach ($langs as $lang) {
            $data = ["nom_langage" => $lang];
            $this->insert($data);
        }
    }*/

}

/* End of file Langage_model.php */
/* Location: ./application/models/Langage_model.php */
