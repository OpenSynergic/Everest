<?php

namespace Everest;

use App\Classes\Theme;

use App\Facades\Hook;
use App\Forms\Components\TinyEditor;
use Filament\Forms\Components\ColorPicker;
use luizbills\CSS_Generator\Generator as CSSGenerator;
use matthieumastadenis\couleur\ColorFactory;
use matthieumastadenis\couleur\ColorSpace;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class EverestTheme extends Theme
{
	public function boot()
	{
		Blade::anonymousComponentPath($this->getPluginPath('resources/views/frontend/website/components'), 'everest');
	}
	
	public function getFormSchema() : array 
	{
		return [
			SpatieMediaLibraryFileUpload::make('images') 
				->collection('everest-header')
				->label('Upload Header Images')
				->multiple() 
				->maxFiles(4)
				->image()
				->conversion('thumb-xl'),
			ColorPicker::make('appearance_color')
				->regex('/^#?(([a-f0-9]{3}){1,2})$/i')
				->label(__('general.appearance_color')),
			
			// Layouts
			Builder::make('layouts')
				->blocks([
					Builder\Block::make('layouts')
						->schema([
							TextInput::make('name_content')
								->label('Name')
								->required(),
							TinyEditor::make('about')
								->label('About Site')
								->profile('advanced')
								->required(),
							
						]),
					
				])
			->reorderableWithButtons()
			->collapsed()
			->reorderableWithDragAndDrop(false),
		];
	}

	public function onActivate(): void
	{	
		Hook::add('Frontend::Views::Head', function ($hookName, &$output){
			$output .= '<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>';
			$css = $this->url('everest.css');
			$output .= "<link rel='stylesheet' type='text/css' href='$css'/> ";

			if ($appearanceColor = $this->getSetting('appearance_color')) {
				$oklch = ColorFactory::new($appearanceColor)->to(ColorSpace::OkLch);
				$css = new CSSGenerator();
				$css->root_variable('p', "{$oklch->lightness}% {$oklch->chroma} {$oklch->hue}");
	
				$output .= <<<HTML
					<style>
						{$css->get_output()}
					</style>
				HTML;
			}

		});

	}

	public function getFormData() : array 
	{
		return [
			'images' => $this->getSetting('images'),
			'appearance_color' => $this->getSetting('appearance_color'),
			'layouts' => $this->getSetting('layouts'),
			'name_content' => $this->getSetting('name_content'),
			'about' => $this->getSetting('about'),
		];
	}
}