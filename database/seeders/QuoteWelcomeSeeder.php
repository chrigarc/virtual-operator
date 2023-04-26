<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Str;

class QuoteWelcomeSeeder extends Seeder
{

    private $quotes = [
        '¡Hola! ¡Qué bueno verte de nuevo!',
        '¿Cómo estuvo tu día?',
        'Pensé que nunca llegarías.',
        'Te extrañé mucho.',
        '¡Qué alegría que estés aquí!',
        '¡Bienvenido a casa!',
        'Me encanta cuando vienes a visitarme.',
        '¿Qué tal estuvo el tráfico?',
        '¡Por fin estás aquí!',
        'Tengo muchas ganas de contarte lo que me pasó hoy.',
        '¿Quieres algo de beber?',
        'Estaba esperando tu llamada.',
        'Me alegra ver que estás bien.',
        '!Hola cariño! ¿Cómo te fue en el trabajo?',
        'Te preparé tu comida favorita.',
        'Estaba pensando en ti todo el día.',
        '¡Qué bueno que estás de vuelta!',
        '¿Te gustaría relajarte un rato?',
        '¿Quieres ver una película juntos?',
        '¡Te extrañé muchísimo!'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->quotes as $quote){
            $slug = Str::slug($quote);
            $quoteObj = Quote::firstOrNew(['slug' => $slug]);
            $quoteObj->fill([
               'type' => 'welcome',
               'content' => $quote
            ]);
            $quoteObj->save();
        }
    }
}
