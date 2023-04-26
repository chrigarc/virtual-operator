<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuoteAskSeeder extends Seeder
{
    private $quotes = [
        '¿Cómo estás?',
        '¿Cómo están las cosas contigo?',
        '¿Qué has estado haciendo últimamente?',
        '¿Cómo está la familia?',
        '¿Has estado ocupado últimamente?',
        '¿Qué planes tienes para el fin de semana?',
        '¿Cómo están las cosas en tu vida?',
        '¿Has hecho algún viaje recientemente?',
        '¿Cómo está tu salud?',
        '¿Has hablado con tus familiares últimamente?',
        '¿Cómo va tu trabajo?',
        '¿Has visto alguna buena película o programa de televisión últimamente?',
        '¿Hay alguna novedad en tu vida que me gustaría saber?',
        '¿Cómo van tus proyectos?',
        '¿Hay algo que necesites que te pueda ayudar?',
        '¿Tienes alguna preocupación o inquietud que quieras hablar?',
        '¿Cómo va tu vida amorosa?',
        '¿Hay algún evento familiar próximo al que debamos asistir?',
        '¿Has estado haciendo ejercicio o practicando algún deporte últimamente?',
        '¿Quieres que planifiquemos algo juntos en el futuro cercano?'
    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->quotes as $quote) {
            $slug = Str::slug($quote);
            $quoteObj = Quote::firstOrNew(['slug' => $slug]);
            $quoteObj->fill([
                'type' => 'ask',
                'content' => $quote
            ]);
            $quoteObj->save();
        }
    }
}
