<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuoteByeSeeder extends Seeder
{
    private $quotes = [
        'Fue muy agradable hablar contigo, nos hablamos pronto.',
        'Me encantó escuchar tu voz, te quiero mucho.',
        'Te agradezco por tomarte el tiempo de hablar conmigo, cuídate.',
        'Me alegra saber que estás bien, cuídate mucho.',
        'Gracias por hacerme sonreír hoy, hablamos pronto.',
        'Espero que tengas un buen día/tarde/noche, nos hablamos luego.',
        'Me encantó ponernos al día, cuídate mucho.',
        'Siempre es un placer hablar contigo, te mando un abrazo.',
        'Me alegra saber que todo va bien, hablamos pronto.',
        'Si necesitas algo, no dudes en llamarme, te quiero mucho.',
        'Fue muy agradable compartir contigo, nos hablamos pronto.',
        'Gracias por tu tiempo, cuídate mucho.',
        'Me encantó escuchar tus historias, te mando un beso.',
        'Siempre es bueno hablar contigo, cuídate.',
        'Me alegra que hayamos tenido esta conversación, te quiero mucho.',
        'Fue genial escuchar tus consejos, hablamos pronto.',
        'Siempre me haces sentir mejor, te mando un abrazo.',
        'Me alegra saber que todo va bien, cuídate mucho.',
        'Siempre eres una luz en mi vida, te quiero mucho.',
        'Gracias por tu cariño, nos hablamos pronto.'
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
                'type' => 'bye',
                'content' => $quote
            ]);
            $quoteObj->save();
        }
    }
}
