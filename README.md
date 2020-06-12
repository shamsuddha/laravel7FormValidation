<h1> FORM VALIDATION</h1>


1. VALIDATION IN A CONTROLLER AND SHOW ERROR IN BLADE


// IN CONTROLLER
------------------------------------------
  public function store(Request $request){
 
         $request->validate([
             'title' => 'required',
             'body' => 'required',
             'image' => 'required',
             'vehicle' =>'required',
         ]);
 
         return back()->withInput();
 
     }
     
// IN BLADE
-----------------------------------------
     @if ($errors->any())
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif


@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror




------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------

2. THROUGH ARTISAN COMMAND TO MAKE MY OWN CUSTOM REQUEST


// IN COMMAND LINE

php artisan make:request StorePost
------------------------------------------------------------------

//Then in Requests>>StorePost.php

 public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'image' => 'required',
            'vehicle' =>'required',
        ];
    }
    
-----------------------------------------------------------------------    
 // IN CONTROLLER
 
       $validated = $request->validated();

---------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------

3. ADD CUSTOM Validation message (STOREPOST.PHP)


public function messages()
{
    return [
        'title.required' => 'A title is required',
        'body.required'  => 'A message is required',
    ];
}

---------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------

4. ADD CUSTION VALIDATION ATTRIBUTE (STOREPOST.PHP)

public function attributes()
{
    return [
        'email' => 'email address',
    ];
}
---------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------

5. MANUALLY CREATING VALIDATION IN CONTROLLER

  public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Store the blog post...
    }

--------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------

LARAVEL BUILT IN VALIDATION RULES

1. ACCEPTED (check for terms, is it accepted or not)
2. ACTIVE URL (check the website url is active or not, work only on internet connection)
3. after:date (will select a date after that date)
4. after_or_equal:date (will select a date equal or after the date)
5. alpha
6. array (checkbox arary)
7. Bail (Stop running validation rules after the first validation failure.)
8. before:date
9. between:min,max
10. boolean
11. confirmed

















