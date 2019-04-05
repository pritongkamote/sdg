<?php 

    
    require_once 'vendor/autoload.php';

class generation {
    
    public $faker_name;
    public $faker_number;
    public $db;
    public $numberToGenerate;
    public $globe = array(
        "0926",
        "0966",
        "0915",
        "0935",
        "0967",
        "0916",
        "0936",
        "0975",
        "0917",
        "0905",
        "0927",
        "0956",
        "0906",
        "0977",
        "0995",
        "0997",
        "0945",
        "0965",
        "0955"
    );

    // CREATE DATABASE contacts;
    // CREATE USER 'contacts_user'@'localhost' IDENTIFIED BY 'contactsS123!@$!';
    // CREATE USER 'contacts_user'@'%' IDENTIFIED BY 'contactsS123!@$!';
    
    // GRANT ALL PRIVILEGES ON contacts . * TO 'contacts_user'@'localhost';
    // GRANT ALL PRIVILEGES ON contacts . * TO 'contacts_user'@'%';
    //  CREATE TABLE `contacts`.`tbl_contacts` (
    //   `id` INT NOT NULL AUTO_INCREMENT,
    //   `name` VARCHAR(45) NOT NULL,
    //   `number` VARCHAR(45) NOT NULL,
    //   PRIMARY KEY (`id`));

    
    public function __construct($numberToGenerate){
        $this->numberToGenerate = $numberToGenerate;
        $this->init();

        for($i=1; $i<=$numberToGenerate; $i++){
            $this->generate_contact();
            $this->save_mobile_nummber();
            $this->createVFC();
        }

    }

    public function init(){
        $this->db = new mysqli("172.17.0.1", "contacts_user", "contactsS123!@$!","contacts");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    public function generate_contact(){        
        $faker = Faker\Factory::create();
        $this->faker_name = $faker->name;
        $this->faker_number = $this->globe[array_rand($this->globe)].$faker->numberBetween(1000000,9999999);
        $i=true;
        while($i) {
            $this->init();
            $faker = Faker\Factory::create();
            $this->faker_number = $this->globe[array_rand($this->globe)].$faker->numberBetween(1000000,9999999);
            $i = $this->db->query("Select count(*) as count from `tbl_contacts` where number='$this->faker_number';")->fetch_assoc()[0]->count==0 ? false:true ;
        }
        
    }
    
    public function save_mobile_nummber(){
        $this->init();
        // INSERT INTO `tbl_contacts` (`name`, `number`) VALUES ('vic ', '09178032215');
        $sql = "INSERT INTO `tbl_contacts` (`name`, `number`) VALUES ('".$this->db->real_escape_string($this->faker_name)."', '".$this->faker_number."');";
        if ($this->db->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    public function createVFC(){
        $myfile = fopen("00002.vcf", "a") or die("Unable to open file!");
        fwrite($myfile, $this->generateVFC());
        fclose($myfile);
    }

    public function generateVFC(){
        $newline = "\n";
        $contact = "BEGIN:VCARD".$newline;
        $contact .= "VERSION:2.1".$newline;
        $contact .= "N:;".$this->faker_name.";;;".$newline;
        $contact .= "FN:".$this->faker_name."".$newline;
        $contact .= "TEL;CELL:".$this->faker_number."".$newline;
        $contact .= "X-GROUP-MEMBERSHIP:My Contacts".$newline;
        $contact .= "END:VCARD".$newline;
        return $contact;
    }

    public function getGenerated(){
        return ['name'=>$this->faker_name,'number'=>$this->faker_number];
    }

}



// $generation = new generation();
// echo $generation->rand_name();
// print_r($generation->getGenerated());
// print_r($contact);

$generation = new generation(10000);


// print_r($generation);
// 0817	Globe	
// 0926	Globe
// 0966	Globe
// 0915	Globe
// 0935	Touch
// 0967	Globe
// 0916	Globe
// 0936	Globe
// 0975	Globe
// 0917	Globe
// 0905	Globe
// 0927	Globe
// 0956	Globe
// 0906	Globe
// 0977	Globe
// 0995	Globe
// 0997	Globe
// 0945	Globe
// 0965	Touch Mobile
// 0955	Touch Mobile

// 0946	Talk N Text
// 0948	Talk N Text
// 0907	Talk N Text	
// 0950	Talk N Text
// 0930	Talk N Text	
// 0909	Talk N Text	
// 0910	Talk N Text	
// 0912	Talk N Text	
// 0938	Talk N Text	
// 0947	Smart
// 0813	Smart	
// 0929	Smart	
// 0908	Smart	
// 0918	Smart
// 0919	Smart	
// 0939	Smart	
// 0928	Smart	
// 0949	Smart
// 0920	Smart
// 0921	Smart	
// 0998	Smart
// 0999	Smart
// 0996	Cherry Mobile
// 0937	ABS-CBN Mobile	
// 0923	Sun Cellular	
// 0944	Sun Cellular	
// 0925	Sun Cellular
// 0943	Sun Cellular	
// 0922	Sun Cellular	
// 0942	Sun Cellular	
// 0933	Sun Cellular	
// 0932	Sun Cellular	
// 0931	Sun Cellular	
