<?php

namespace App\Http\Livewire\Admin\Categorypage\Electronic;

use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Title extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $title;
    public $link;
    public $search;


    protected $queryString = ['search'];

    public $readyToLoad = false;


    public function categoryForm()
    {
//        $titles = DB::connection('mysql-electronic')->table('category_electronic_title_swiper')->insert([
        $titles = DB::table('category_electronic_title_swiper')->insert([
            'title' => $this->title,
            'link' => $this->link,
        ]);
        $this->title = "";
        $this->link = "";
        Log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن عناوین' . '-' . $this->title,
            'actionType' => 'ایجاد'
        ]);
        $this->emit('toast', 'success', ' عناوین با موفقیت ایجاد شد.');

    }


    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function deleteCategory($id)
    {
//        $banner2 = DB::connection('mysql-electronic')->table('category_electronic_title_swiper')
        $banner2 = DB::table('category_electronic_title_swiper')
            ->where('id', $id)->first();
//        $banner = DB::connection('mysql-electronic')->table('category_electronic_title_swiper')
        $banner = DB::table('category_electronic_title_swiper')
            ->where('id', $id)->limit($id);
        $banner->delete();

        Log::create([
            'user_id' => auth()->user()->id,
            'url' => 'حذف کردن عناوین' . '-' . $banner2->title,
            'actionType' => 'حذف'
        ]);
        $this->emit('toast', 'success', ' عناوین با موفقیت حذف شد.');

    }

    public function render()
    {

//        $titles = $this->readyToLoad ? DB::connection('mysql-electronic')->table('category_electronic_title_swiper')
        $titles = $this->readyToLoad ? DB::table('category_electronic_title_swiper')
            ->where('title', 'LIKE', "%{$this->search}%")->
            orWhere('id', $this->search)->
            latest()->paginate(15) : [];
        return view('livewire.admin.categorypage.electronic.title', compact('titles'));
    }
}
