<?php

// Create a PDO instance
$host = 'localhost';
$dbname = 'mychat';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
} catch(PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}


class UserModel{
    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // create user
    public function CreateUser($data){

        $stmt = $this->pdo->prepare("INSERT INTO users (username,email,sex, password) VALUES (:username,:email,:sex, :password)");

        $stmt->execute($data);

    }

    // public function test(){
    //     echo "hi";
    // }
    
    // login user
    public function LoginUser($data){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email OR id = :id");
        $stmt->execute(['email' => $data, 'id' => $data]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the email exists in the database
        if ($stmt->rowCount() > 0) {
            // Email exists in the database
            return $user;
        } else {
            // Email does not exist in the database
            return false;
}

    }
    public function get_contacts($user_id){
        $stmt =$this->pdo->prepare("SELECT * FROM users where id != '$user_id' ");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if the email exists in the database
        if ($stmt->rowCount() > 0) {
            // Email exists in the database
            return $users;
        } else {
            // Email does not exist in the database
            return array();
}

    }


        // update user data for a specific ID
        public function UpdateUser($id, $data) {
            
            $stmt = $this->pdo->prepare("UPDATE users SET username = :username, email = :email, sex = :sex WHERE id = :id");
            $result = $stmt->execute(array_merge($data, ['id' => $id]));
            if ($result) {
                // Update was successful
                return array("outcome" => "successful");
            } else {
                // Update failed
                return array("outcome" => "unsuccessful");
            }
        }

        public function get_contact($user_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :user_id");
            $stmt->execute([':user_id' => $user_id]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Check if the user exists in the database
            if ($stmt->rowCount() > 0) {
                // User exists in the database
                return $users;
            } else {
                // User does not exist in the database
                return array();
            }
        }
        
}





class Message{


    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    //insert message
    public function CreateMessage($data){

        $stmt = $this->pdo->prepare("INSERT INTO message (sender_id, receiver_id, message) VALUES (:sender_id,:receiver_id, :message)");

        $stmt->execute([
            ':sender_id' => $data['sender_id'],
            ':receiver_id' => $data['receiver_id'],
            ':message' => $data['message']
        ]);

    }


    //getting messages between sender and reciever
    public function get_message($sender_id,$receiver_id){
        $stmt =$this->pdo->prepare("SELECT * FROM message WHERE (sender_id = $sender_id AND receiver_id = $receiver_id) OR (sender_id = $receiver_id AND receiver_id = $sender_id) ORDER BY date ASC");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        if ($stmt->rowCount() > 0) {
           
            return $users;
        } else {
        
            return array();
}

    }


    //chat partners


    public function chat_partners($id) {
        $stmt = $this->pdo->prepare("SELECT DISTINCT
                                    CASE 
                                        WHEN m.sender_id = :id THEN m.receiver_id
                                        ELSE m.sender_id
                                    END AS chat_partner_id,
                                    MAX(m.date) AS last_chat_date
                                    FROM message AS m
                                    WHERE m.sender_id = :id OR m.receiver_id = :id
                                    GROUP BY chat_partner_id
                                    ORDER BY last_chat_date DESC");
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($stmt->rowCount() > 0) {
            return $users;
        } else {
            return array();
        }
    }
    
        
    
    


}



