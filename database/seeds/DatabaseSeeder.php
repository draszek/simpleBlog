<?php

use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $userRepository;
    private $postRepository;

    public function __construct(UserRepositoryInterface $userRepository, PostRepositoryInterface $postRepository)
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->userRepository->create([
            'name' => 'draszek',
            'email' => 'drzek@gmail.com',
            'password' => bcrypt('qwe123qwe'),
        ]);


        $this->postRepository->create([
            'user_id' => $user->id,
            'image_url' => 'test',
            'title' => 'Your First post',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur accumsan ipsum vitae nisl vestibulum, vitae feugiat tellus laoreet. Nam mi libero, euismod ut orci at, varius maximus est. Mauris vitae tellus vitae sem sollicitudin laoreet. Sed ut convallis ex, blandit pharetra arcu. Vestibulum tincidunt augue nibh, vel porttitor tortor mollis quis. Donec nunc dui, sodales at eros nec, volutpat tempus neque. Vivamus dignissim luctus mauris ac sollicitudin. Aliquam sagittis luctus metus a maximus. Vestibulum malesuada tincidunt nisl quis fermentum.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur accumsan ipsum vitae nisl vestibulum, vitae feugiat tellus laoreet. Nam mi libero, euismod ut orci at, varius maximus est. Mauris vitae tellus vitae sem sollicitudin laoreet. Sed ut convallis ex, blandit pharetra arcu. Vestibulum tincidunt augue nibh, vel porttitor tortor mollis quis. Donec nunc dui, sodales at eros nec, volutpat tempus neque. Vivamus dignissim luctus mauris ac sollicitudin. Aliquam sagittis luctus metus a maximus. Vestibulum malesuada tincidunt nisl quis fermentum.
            Duis eget condimentum felis. Nulla felis leo, blandit eu justo sit amet, pharetra laoreet lacus. Curabitur scelerisque enim quis felis ultricies faucibus. Nulla aliquam nibh consequat pretium rutrum. Aenean maximus, purus non convallis placerat, tellus quam hendrerit sapien, ut auctor dolor metus sagittis mi. Pellentesque quis dignissim lectus, ac pulvinar sapien. Donec tincidunt massa sodales eros lobortis, non lobortis lacus ultrices. Proin rhoncus ex nisi, non mattis tortor maximus eu. Nam venenatis blandit accumsan. Vivamus commodo mi arcu, non dapibus lectus interdum ac. Praesent faucibus orci eu sem iaculis, eget sodales lorem molestie. Morbi felis sapien, viverra vitae augue ut, cursus tempus nisl. Praesent sit amet justo efficitur, convallis eros vitae, scelerisque justo. Quisque non congue ligula. Etiam ut dui dui.
            Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus finibus blandit diam, sit amet faucibus diam rutrum quis. Aliquam id tempor nibh, eu tempus ipsum. Vivamus pellentesque fringilla feugiat. Cras quis mollis augue. Quisque a magna aliquam, gravida ante at, blandit mauris. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec facilisis nisi nibh. Proin accumsan nunc sit amet sapien malesuada, in congue neque mattis. Quisque a odio eu urna iaculis vehicula. Proin nibh risus, convallis non nibh id, vestibulum scelerisque libero. Nulla in massa quis lorem laoreet imperdiet.
            Vestibulum commodo neque a mauris tempus egestas. Phasellus id velit quis felis gravida posuere vel ac erat. Cras posuere, quam vel imperdiet ultrices, augue lectus ultrices lorem, pretium mollis eros ligula eu turpis. Integer nec augue nulla. In sit amet mattis felis. Aenean non arcu eu nisl sodales feugiat sed facilisis dui. Aliquam et arcu turpis. Phasellus nulla enim, volutpat id ligula a, lacinia scelerisque est. Integer turpis ipsum, ultricies at maximus a, auctor et ipsum. Quisque iaculis augue fringilla turpis viverra finibus. Suspendisse convallis mattis dictum. Integer nec purus eu velit rhoncus consequat.'
        ]);

    }
}
