<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;

class CustomersTable extends Component
{
    public $type;
    public $customers;
    public $selected_customer;
    public $selected_customer_id;

    protected $listeners = [
        
    ];

    public function mount() {
        $this->getSelectedCustomer();
        $this->getCustomers();
    }

    public function getSelectedCustomer() {
        $this->selected_customer_id = session()->get('selected_customer_id');
        
        if($this->selected_customer_id) {
            $this->selected_customer = Customer::find($this->selected_customer_id);
        } else {
            $this->selected_customer = collect([]);
        }
    }

    public function getCustomers() {
        $this->customers = Customer::orderBy('name')->get();
    }

    // SELECT

    public function selectCustomer(Customer $customer) {
        $this->selected_customer = $customer;
        $this->selected_customer_id = $customer->id;
        session()->put('selected_customer_id', $this->selected_customer_id);

        $this->emit('customerSelected',$this->selected_customer_id);
    }

    public function clearCustomer(Customer $customer) {
        $this->selected_customer = null;
        $this->selected_customer_id = null;
        session()->forget('selected_customer_id');

        $this->emit('customerCleared',$customer);
    }

    public function render()
    {
        return view('livewire.customers-table');
    }
}
