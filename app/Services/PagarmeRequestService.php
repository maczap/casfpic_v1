<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Crypt;
Use \Carbon\Carbon;

class PagarmeRequestService extends BaseRequestService
{
    private $address;
    private $billing;
    private $shipping;
    private $items;

    public function setAddress($street, $street_number, $zipcode, $country, $state, $city)
    {
        $this->address = [
            'street' => $street,
            'street_number' => $street_number,
            'zipcode' => $zipcode,
            'country' => $country,
            'state' => $state,
            'city' => $city
        ];

        return $this;
    }

    public function setBilling($name)
    {
        $this->billing = [
            'name' => $name,
            'address' => $this->address
        ];
        return $this;
    }

    public function setShipping($name, $fee)
    {
        $this->shipping = [
            'name' => $name,
            'fee' => $fee,
            'address' => $this->address
        ];
        return $this;
    }

    public function addItem($id, $title, $unit_price, $quantity, $tangible = true)
    {
        $item = [
            "id" => (string) $id,
            "title" => $title,
            "unit_price" => $unit_price,
            "quantity" => $quantity,
            "tangible" => $tangible
        ];

        $this->items[] = $item; 
        return $this;
    }

    public function charge(array $customer, $amount, $payment_method, $card_id = null)
    {
        $data = [
            'customer' => [
                'birthday' => $customer['birthday'],
                'name' => $customer['name'],
                'email' => $customer['email'],
                'external_id' => $customer['external_id'],
                'phone_numbers' => $customer['phone_numbers'],
                'documents' => [
                    [
                        'type' => $customer['documents'][0]['type'],
                        'number' => $customer['documents'][0]['number']
                    ]
                ],
                'type' => $customer['type'],
                'country' => $customer['country']
            ],
            'amount' => $this->shipping['fee'] + $amount,
            'async' => false,
            'postback_url' => route('site.postback'),
            'payment_method' => $payment_method,
            'card_id' => $card_id,
            'billing' => $this->billing,
            'shipping' => $this->shipping,
            'items' => $this->items
        ];

        return $this->post('transactions', $data);
    }

    public function getCustomers()
    {
        return $this->get('customers');
    }

    public function getCustomer($id)
    {
        return $this->get(sprintf('%s/%s', 'customers', $id));
    }

    public function createCustomer($name, $email, $external_id, array $phone_numbers, array $documents)
    {
        $type = 'individual';
        $country = 'br';

        $data = [
            'name'           => $name,
            'email'          => $email,
            'external_id'    => (string) $external_id,
            'phone_numbers'  => $phone_numbers,
            'documents'      => $documents,
            
            'type'           => $type,
            'country'        => $country         
        ];

        $result = $this->post('customers', $data);

        if(!isset($result['errors'])){
            $user = User::find($external_id);
            $user->pagarme_id = $result['id'];
            $user->save();
        }

        return $result;
    }

    public function getTransaction($id)
    {
        return $this->get(sprintf('%s/%s', 'transactions', $id));
    }

    public function createCreditCard($customer_id, $card_number, $card_expiration_date, $card_holder_name, $card_cvv)
    {
        $data = [
            'customer_id' => $customer_id,
            'card_number' => $card_number,
            'card_expiration_date' => $card_expiration_date,
            'card_holder_name' => $card_holder_name,
            'card_cvv' => $card_cvv
        ];
        return $this->post('cards', $data);
    }
    public function createTransaction(array $customer, array $documents, $payment_method, $card_id = null, array $address, array $phone, $amount, $items, $plano= null){

        if($payment_method == "cartao"){
            $payment_method = "credit_card";
        }

        if(empty($address["complementary"])){
            unset($address['complementary']);
        }

        unset($customer['object']);
        unset($customer['addresses']);
        unset($customer['phone']);
        unset($customer['phones']);
        unset($customer['document_number']);
        unset($customer['document_type']);
        unset($customer['born_at']);
        unset($customer['birthday']);
        unset($customer['gender']);
        unset($customer['date_created']);

        $customer_all               = $customer;
        $customer_all["documents"]  = $documents;
        

        if($payment_method == "credit_card") {

            $data = [
                'amount'            =>$amount,
                'payment_method'    => $payment_method,
                'card_id'           => $card_id,
                'customer'          => $customer_all,
                'billing'           => [
                    'name'    => $customer["name"],
                    'address' => $address
                ],
                'items'    => [$items],
                'postback_url'      => "https://casfpic.org.br/api/postback",
                'async' => false
            ];
            return $this->post('transactions', $data);
            

        } else if($payment_method == "boleto") {

            $data = [
                'amount'            =>$amount,
                'payment_method'    => $payment_method,
                'customer'          => $customer_all,
                'postback_url'      => "https://casfpic.org.br/api/postback",
                'async' => false
            ];
            return $this->post('transactions', $data);            

        } elseif($payment_method == "pix") {

            $vencimento = $this->vencimento();

            $data = [
                'payment_method'    => $payment_method,
                'postback_url'      => "https://casfpic.org.br/api/postback",
                'amount'            => $amount,
                "pix_expiration_date" => $vencimento,
                'pix_additional_fields' => [
                    [
                        'name' =>'Plano',
                        'value'=> $plano                        
                    ]
                ]
                
            ];            
            return $this->post('transactions', $data);    
        }
        

        
    }

    public function createSubscription(array $customer, $plan_id, $payment_method, $card_id = null, array $address, array $phone, $amount = null, $plano = null)
    {
        if($payment_method == "cartao"){
            $payment_method = "credit_card";
        }
                
        $customer_address = $customer;
        $customer_address["address"] = $address;
        $customer_address["phone"] = $phone;

        if($payment_method == "credit_card") {

            $data = [
                'customer'          => $customer_address,
                'plan_id'           => $plan_id,
                'payment_method'    => $payment_method,
                'soft_descriptor'   => "CASFPIC",
                'card_id'           => $card_id,
                'postback_url'      => "https://casfpic.org.br/api/postback"
            ];

        } elseif($payment_method == "boleto") {

            $data = [
                'customer'          => $customer_address,
                'plan_id'           => $plan_id,
                'payment_method'    => $payment_method,
                'soft_descriptor'   => "CASFPIC",
                'postback_url'      => "https://casfpic.org.br/api/postback"
            ];            

        } 

        return $this->post('subscriptions', $data);
        
    }

    public function createPlan($amount, $days, $name, $payment_methods = null, $trial_days = null)
    {
        $data = [
            'amount' => $amount,
            'days' => $days,
            'name' => $name,
            'payment_methods' => !is_null($payment_methods) ? $this->getPaymentMethods($payment_methods) : null,
            'trial_days' => $trial_days
        ];

        return $this->post('plans', $data);
    }

    public function editPlan($code, $name, $trial_days = null)
    {
        $data = [
            'name' => $name,
            'trial_days' => $trial_days
        ];

        return $this->put(sprintf('%s/%s', 'plans', $code), $data);
    }

    private function getPaymentMethods($type)
    {
        $method = [
            1 => ['boleto'],
            2 => ['credit_card'],
            3 => ['boleto', 'credit_card'],
            4 => ['boleto', 'credit_card','pix']
        ];

        return $method[$type];
    }

    public function getBalance()
    {
        return $this->get('balance');
    }    

    public function vencimento(){

        $atual = Carbon::now();
        $atual = $atual->toDateTimeString();
       
        $vencimento = date('Y-m-d', strtotime('+30 days'));
       
        return $vencimento;        
    }    

}
