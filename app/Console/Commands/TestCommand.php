<?php

namespace App\Console\Commands;

use App\Events\NewOrderEvent;
use App\Events\UserRegistration;
use App\Mail\NewOrderMailToShopOwner;
use App\Mail\TestMail;
use App\Models\Orders;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'balazs:test {user} {date=2020} {id?} {--option}';
    protected $signature = 'balazs:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Balazs test description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::find(1);
        // $order = Orders::find(73);
        Mail::to('balazs.csabak@gmail.com')->send(new TestMail($user));
        // try {
        //     // Mail::to('csabak.balazs@fotex.net')->send(new NewOrderMailToShopOwner($user, $order));
            
        //     // UserRegistration::dispatch($user);
        //     NewOrderEvent::dispatch($user, $order);
        // } catch(Exception $e) {
        //     dd($e);
        // }
        // Mail::to('csabak.balazs@fotex.net')->send(new TestMail());
        
        // $users = $this->withProgressBar(User::all(), function ($user) {
        //     $this->performTask($user);
        // });

        // dd('stop');

        // $this->table(
        //     ['Name', 'Email'],
        //     User::all(['firstname', 'email'])->toArray()
        // );
        // dd('stop');

        // $this->line('Display this on the screen');
        // $this->newLine(3);
        // $this->error('Something went wrong!');
        // $this->newLine();
        // $this->info('The command was successful!');
        // dd('stop');

        // $name = $this->choice(
        //     'What is your name?',
        //     ['Taylor', 'Dayle'],
        //     1
            
        // );
        // dd($name);

        // $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
        // dd($name);


        // if($this->confirm('Do you wish to continue?')) {
        //     dd('true');
        // } else {
        //     dd('false');
        // }


        // $password = $this->secret('What is the password?');
        // dd($password);

        // $name = $this->ask('What is your name?');
        // dd($name);

        // dd($this->options());
        // dd($this->option('option'));
        // dd($this->argument('user'));
        // dd($this->arguments());
        // return 0;
    }
}
