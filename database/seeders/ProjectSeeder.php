<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Seeds the projects table with the predefined project records.
     *
     * Existing records are updated by title, and missing records are inserted.
     */
    public function run(): void
    {
        // Crear proyectos de ejemplo
        $projects = [
            [
                'title' => 'Proyecto 1',
                'description' => 'Descripción del proyecto 1',
                'image_carousel' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5vdOzTnNRzmfPzdCoyKzg1W9rzTm8kRzkxbq5BFAebev6_oDRO-6DlQqxQuhau9MdtH3tIvifHDjuDLTgiM2m4G7xsSM1R4XBrrCH2IC1WXRtuvxLOD3RNH8zkzh45ckTXL_wAs5Y6rnbFnX-7jXQHOVz9R6TptSPNOgmrNiZWst0eAvonXThEQHFZHCPfp852NeU-sfbqAZVvpwBfoP6itam4o1maFbHaozRY0scJD0bk7CbFKeymVQgkaSvxG6avDExRvwJAWg0',
                'image_grid' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5vdOzTnNRzmfPzdCoyKzg1W9rzTm8kRzkxbq5BFAebev6_oDRO-6DlQqxQuhau9MdtH3tIvifHDjuDLTgiM2m4G7xsSM1R4XBrrCH2IC1WXRtuvxLOD3RNH8zkzh45ckTXL_wAs5Y6rnbFnX-7jXQHOVz9R6TptSPNOgmrNiZWst0eAvonXThEQHFZHCPfp852NeU-sfbqAZVvpwBfoP6itam4o1maFbHaozRY0scJD0bk7CbFKeymVQgkaSvxG6avDExRvwJAWg0',
                'grid_image_size' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Proyecto 2',
                'description' => 'Descripción del proyecto 2',
                'image_carousel' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCRnmskudL9AdnStX3CN3gmoEtZa-3fz2jwLz2wu1I4N6LbjVmKi---U7aeTfFlfn4Ulys4zXbkkRrLv7suzAnandazrYPGfsylxT1V9rb7IFzvurh2jLEl75jTEgn7788UaYbR_7E1THhfnGEFwomUcYv21rdOUzCjK-q34Go-fc9d_NlyWjbV_Lq_9pcXfKJnONuZX5sc1a_y_mDOm6ITZKSWG7r59OMhxCyt2kQDQ_zp5CGnYOC8E0WKsX_ZU2TVDn3lnNqn9lRI',
                'image_grid' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCRnmskudL9AdnStX3CN3gmoEtZa-3fz2jwLz2wu1I4N6LbjVmKi---U7aeTfFlfn4Ulys4zXbkkRrLv7suzAnandazrYPGfsylxT1V9rb7IFzvurh2jLEl75jTEgn7788UaYbR_7E1THhfnGEFwomUcYv21rdOUzCjK-q34Go-fc9d_NlyWjbV_Lq_9pcXfKJnONuZX5sc1a_y_mDOm6ITZKSWG7r59OMhxCyt2kQDQ_zp5CGnYOC8E0WKsX_ZU2TVDn3lnNqn9lRI',
                'grid_image_size' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Proyecto 3',
                'description' => 'Descripción del proyecto 3',
                'image_carousel' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRGewAh8EVDQ56-CNX7lENAkQUDyx6_BEGaydMU82UW1SxejwSppOjgb2IbcmmK7l5UnDPNEOzbJlkyMI4eIKE57Sg1iRKyrP-jHHWNm-1Ry7HK75ayrgOqvJWLR9hpWSwOVG7DrYeCcjT38uj1KU9Me1sFxfVS5XBLv4baFebq9J7ETVOw7snGV6WYENK0C2XONXlDsDXNS9fJ1KAA-cQtA_U8ubA7WS6yeG4o-WhGp7G7fCBVcHOMWuElSSHYoLQDdCJ-pNS1PRL',
                'image_grid' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRGewAh8EVDQ56-CNX7lENAkQUDyx6_BEGaydMU82UW1SxejwSppOjgb2IbcmmK7l5UnDPNEOzbJlkyMI4eIKE57Sg1iRKyrP-jHHWNm-1Ry7HK75ayrgOqvJWLR9hpWSwOVG7DrYeCcjT38uj1KU9Me1sFxfVS5XBLv4baFebq9J7ETVOw7snGV6WYENK0C2XONXlDsDXNS9fJ1KAA-cQtA_U8ubA7WS6yeG4o-WhGp7G7fCBVcHOMWuElSSHYoLQDdCJ-pNS1PRL',
                'grid_image_size' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Proyecto 4',
                'description' => 'Descripción del proyecto 4',
                'image_carousel' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5vdOzTnNRzmfPzdCoyKzg1W9rzTm8kRzkxbq5BFAebev6_oDRO-6DlQqxQuhau9MdtH3tIvifHDjuDLTgiM2m4G7xsSM1R4XBrrCH2IC1WXRtuvxLOD3RNH8zkzh45ckTXL_wAs5Y6rnbFnX-7jXQHOVz9R6TptSPNOgmrNiZWst0eAvonXThEQHFZHCPfp852NeU-sfbqAZVvpwBfoP6itam4o1maFbHaozRY0scJD0bk7CbFKeymVQgkaSvxG6avDExRvwJAWg0',
                'image_grid' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5vdOzTnNRzmfPzdCoyKzg1W9rzTm8kRzkxbq5BFAebev6_oDRO-6DlQqxQuhau9MdtH3tIvifHDjuDLTgiM2m4G7xsSM1R4XBrrCH2IC1WXRtuvxLOD3RNH8zkzh45ckTXL_wAs5Y6rnbFnX-7jXQHOVz9R6TptSPNOgmrNiZWst0eAvonXThEQHFZHCPfp852NeU-sfbqAZVvpwBfoP6itam4o1maFbHaozRY0scJD0bk7CbFKeymVQgkaSvxG6avDExRvwJAWg0',
                'grid_image_size' => 2,
                'is_active' => false,
            ],
        ];

        foreach ($projects as $projectData) {
           DB::table('projects')->updateOrInsert(
            ['title' => $projectData['title']], 
            [
                'description' => $projectData['description'],
                'image_carousel' => $projectData['image_carousel'],
                'image_grid' => $projectData['image_grid'],
                'grid_image_size' => $projectData['grid_image_size'],
                'is_active' => $projectData['is_active'],
            ]
            );
        }
    }
}
