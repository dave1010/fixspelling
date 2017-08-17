<?php

require_once __DIR__ . '/fixspelling.php';

class Foo
{
    public function authorize()
    {
        return "Authorized\n";
    }

    public function authenticate()
    {
        return "Authenticated\n";
    }
}

$foo = new Foo();

echo fixspelling($foo)->authorise();
echo fixspelling($foo)->thenticate();
echo fixspelling($foo)->auth();


