<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuoteFunFactsSeeder extends Seeder
{
    private $quotes = [
        'Sabias que Los gatos tienen una forma única de caminar llamada "paso de camello".',
        'Sabias que Los flamingos pueden beber agua hirviendo sin sufrir daño.',
        'Sabias que El corazón de una ballena azul es tan grande que una persona podría nadar por sus arterias.',
        'Sabias que Las hormigas no tienen pulmones, en su lugar respiran a través de pequeños orificios en su exoesqueleto.',
        'Sabias que El cerebro humano es más activo cuando dormimos que cuando vemos televisión.',
        'Sabias que Los científicos han descubierto una nueva especie de mono cada dos años en promedio en la última década.',
        'Sabias que La Gran Muralla China es en realidad una serie de muros y fortificaciones construidos en diferentes épocas.',
        'Sabias que Los tiburones tienen que seguir moviéndose para poder respirar.',
        'Sabias que El actor Danny DeVito tiene un pequeño papel en la película "Pulp Fiction" como el dueño de una cafetería.',
        'Sabias que La famosa cerveza Guinness tarda 119.5 segundos en ser servida perfectamente.',
        'Sabias que En Escocia, se celebraba la Navidad por tres días hasta el siglo XVII.',
        'Sabias que El sonido de los rayos se llama "trueno".',
        'Sabias que El ojo humano puede distinguir aproximadamente 10 millones de colores diferentes.',
        'Sabias que La canción "Happy Birthday" es la canción con derechos de autor más rentable de la historia.',
        'Sabias que Los koalas tienen huellas dactilares únicas al igual que los seres humanos.',
        'Sabias que El agua hirviendo se congela más rápido que el agua fría en algunas circunstancias.',
        'Sabias que Las ratas son capaces de reír cuando son cosquilleadas.',
        'Sabias que Los pingüinos pueden saltar hasta seis pies en el aire.',
        'Sabias que El diamante es el mineral más duro que se conoce hasta el momento.',
        'Sabias que El actor Tom Hanks es uno de los coleccionistas más grandes del mundo de máquinas de escribir antiguas.'
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
                'type' => 'fun-fact',
                'content' => $quote
            ]);
            $quoteObj->save();
        }
    }
}
