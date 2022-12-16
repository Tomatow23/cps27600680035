<?php
require_once("classes/StickyForm.php");

$stickyForm = new StickyForm();

function init(){
    global $elementsArr, $stickyForm;

    if(isset($_POST['submit']))
    {
        $postArr = $stickyForm->validateForm($_POST, $elementsArr);

        if($postArr['masterStatus']['status'] == "noerrors")
        {
            return addData();
        }
        else
        {
            return getForm("",$postArr);
        }
    }
    else
    {
        return getForm("", $elementsArr);
    }
}

$elementsArr = [
    "masterStatus"=>[
      "status"=>"noerrors",
      "type"=>"masterStatus"
    ],
      "name"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
      "errorOutput"=>"",
      "type"=>"text",
      "value"=>"John Doe",
          "regex"=>"name"
      ],
      "phone"=>[
          "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be a valid phone number</span>",
      "errorOutput"=>"",
      "type"=>"text",
          "value"=>"999.999.9999",
          "regex"=>"phone"
    ],
    "address"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Address cannot be blank and must be a valid address</span>",
    "errorOutput"=>"",
    "type"=>"text",
        "value"=>"123 Somewhere",
        "regex"=>"address"
  ],
    "city"=>[
      "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Please enter a valid city</span>",
  "errorOutput"=>"",
  "type"=>"text",
      "value"=>"Anywhere",
      "regex"=>"city"
  ],
    "state"=>[
      "type"=>"select",
      "options"=>["MI"=>"Michigan","OH"=>"Ohio","PA"=>"Pennslyvania","TX"=>"Texas", "AK"=>"Alaska"],
          "selected"=>"oh",
          "regex"=>"name"
      ],
   "email"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Please enter a valid email address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"johndoe@example.com",
        "regex"=>"email"
      ],
    "contacts"=>[
      "type"=>"checkbox",
      "action"=>"notRequired",
      "status"=>["newsletter"=>"", "emailUpdates"=>"", "textUpdates"=>""]
    ],
    "DOB"=>[
      "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Please enter a valid date mm/dd/yyyy</span>",
      "errorOutput"=>"",
      "type"=>"text",
      "value"=>"12/04/1987",
      "regex"=>"DOB"
],
    
    "age"=>[
      "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must select an age</span>",
      "errorOutput"=>"",
      "type"=>"radio",
      "action"=>"required",
      "value"=>["10-18"=>"", "19-30"=>"", "30-50"=>"", "51+"=>""]
    ]
  ];
  
  
function addData()
{
    global $elementsArr;  
    require_once("classes/Pdo_methods.php");
    $pdo = new PdoMethods();
    $sql = "INSERT INTO contacts (name, address, city, phone, email, DOB, contact, age, state) VALUES (:name, :address, :city, :phone, :email, :DOB, :contact, :age, :state)";
    if(isset($_POST["contacts"]))
    {
      $contact = implode(", ", $_POST["contacts"]);
    }
    else
    {
      $contact = "";
    }
    
    $bindings = [
        [":name", $_POST["name"], "str"],
        [":address", $_POST["address"], "str"],
        [":city", $_POST["city"], "str"],
        [":phone", $_POST["phone"], "str"],
        [":email", $_POST["email"], "str"],
        [":DOB", $_POST["DOB"], "str"],
        [":contact", $contact, "str"],
        [":age", $_POST["age"], "str"],
        [":state", $_POST["state"], "str"],
    ];

    if ($pdo->otherBinded($sql, $bindings) == "error")
    {
        return getForm("Error Sumbitting Form.", $elementsArr);
    }

    return getForm("Contact Information Added", $elementsArr);
}

function getForm($acknowledgement, $elementsArr)
{
    global $stickyForm;
$options = $stickyForm->createOptions($elementsArr['state']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php?page=form">
    <div class="form-group">
      <label for="name">Name (letters only){$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>
    <div class="form-group">
      <label for="address">Address (just numbers and street) {$elementsArr['address']['errorOutput']}</label>
      <input type="text" class="form-control" id="address" name="address" value="{$elementsArr['address']['value']}" >
    </div>
    <div class="form-group">
      <label for="city">City {$elementsArr['city']['errorOutput']}</label>
      <input type="text" class="form-control" id="city" name="city" value="{$elementsArr['city']['value']}" >
    </div>
    <div class="form-group">
      <label for="state">State</label>
      <select class="form-control" id="state" name="state">
        $options
      </select>
    </div>
    <div class="form-group">
      <label for="phone">Phone (format 999.999.9999) {$elementsArr['phone']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
    </div>
    <div class="form-group">
      <label for="email">Email {$elementsArr['email']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
    </div>
    <div class="form-group">
      <label for="DOB">Date of Birth {$elementsArr['DOB']['errorOutput']}</label>
      <input type="text" class="form-control" id="DOB" name="DOB" value="{$elementsArr['DOB']['value']}" >
    </div>
    <p>Please check all contact types you would like (optional)</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="Newsletter" value="newsletter" {$elementsArr['contacts']['status']['newsletter']}>
      <label class="form-check-label" for="Newsletter">Newsletter</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="Email Updates" value="emailUpdates" {$elementsArr['contacts']['status']['emailUpdates']}>
      <label class="form-check-label" for="Email Updates">Email Updates</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="Text Updates" value="textUpdates" {$elementsArr['contacts']['status']['textUpdates']}>
      <label class="form-check-label" for="Text Updates">Text Updates</label>
    </div>
        
    <p>Please select an eye color(you must check at least one):{$elementsArr['age']['errorOutput']}</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age1" value="10-18"  {$elementsArr['age']['value']['10-18']}>
      <label class="form-check-label" for="age1">10-18</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age2" value="19-30"  {$elementsArr['age']['value']['19-30']}>
      <label class="form-check-label" for="age2">19-30</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age3" value="30-50"  {$elementsArr['age']['value']['30-50']}>
      <label class="form-check-label" for="age3">30-50</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age4" value="51+"  {$elementsArr['age']['value']['51+']}>
      <label class="form-check-label" for="age4">51+</label>
    </div>
    <div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
HTML;

return [$acknowledgement, $form];

}

?>