<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'user_id' => 1,
                'title'   => 'Lembrete de manutenção',
                'content' => 'O sistema passará por uma atualização breve nesta madrugada.',
            ],
            [
                'user_id' => 2,
                'title'   => 'Dúvida sobre o perfil',
                'content' => 'Como faço para alterar minha foto de exibição no painel?',
            ],
            [
                'user_id' => 1,
                'title'   => 'Nova funcionalidade',
                'content' => 'Acabamos de liberar o módulo de relatórios para todos os usuários.',
            ],
            [
                'user_id' => 2,
                'title'   => 'Sugestão de melhoria',
                'content' => 'Seria interessante ter um modo escuro na interface principal.',
            ],
            [
                'user_id' => 1,
                'title'   => 'Ticket encerrado',
                'content' => 'Seu pedido de suporte foi finalizado com sucesso. Avalie nosso atendimento.',
            ],
            [
                'user_id' => 2,
                'title'   => 'Erro ao carregar imagem',
                'content' => 'Estou tentando subir um arquivo PNG, mas o sistema retorna erro 500.',
            ],
            [
                'user_id' => 1,
                'title'   => 'Dica de segurança',
                'content' => 'Nunca compartilhe sua senha com terceiros, nem mesmo com administradores.',
            ],
            [
                'user_id' => 2,
                'title'   => 'Feedback positivo',
                'content' => 'A velocidade de carregamento das páginas melhorou muito após a última versão.',
            ],
            [
                'user_id' => 1,
                'title'   => 'Verificação necessária',
                'content' => 'Por favor, confirme seu endereço de e-mail para continuar utilizando todos os recursos.',
            ],
            [
                'user_id' => 2,
                'title'   => 'Acesso via API',
                'content' => 'Onde encontro a documentação para integrar meu sistema via token?',
            ],
        ];

        DB::table('posts')->insert($posts);
    }
}
