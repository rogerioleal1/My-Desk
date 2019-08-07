<?php

return [
    'Preferências' => [
        [
            'name'  => 'Alterar Usuário',
            'route' => 'profile.edit',
        ],
        [
            'name'  => 'Meu Perfil',
            'route' => 'profile',
        ],
        [
            'name'  => 'Grupos',
            'route' => 'groups.index',
        ],
        [
            'name'  => 'Usuários',
            'route' => 'users.index',
        ],
    ],
    'Configurações' => [
        [
            'name'  => 'Configurações Gerais',
            'route' => 'settings.index',
        ],
        [
            'name'  => 'Avisos',
            'route' => 'messages.index',
        ],
        [
            'name'  => 'Empresas',
            'route' => 'companies.index',
        ],
        [
            'name'  => 'Sistemas',
            'route' => 'systems.index',
        ],
        [
            'name'  => 'Permissões',
            'route' => 'permissions.index',
        ],
    ],
    'Chamados' => [
        [
            'name'  => 'Categorias de Chamados',
            'route' => 'categories.index',
        ],
        [
            'name'  => 'Meus Chamados',
            'route' => 'tickets.index',
        ],
        [
            'name'  => 'Novo Chamado',
            'route' => 'tickets.create',
        ],
    ],
];
