

/*==================================================
================ Remove invalid class
=====================================================*/
const inputs = document.querySelectorAll(".form-control");

for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('click', function (event) {
        this.classList.remove("is-invalid");
        var textDanger = this.parentElement.querySelector(".text-danger");
        textDanger.style.display = "none";
    });
}
/*==================================================
================ Scroll To Top
=====================================================*/
const scrollBtn = document.getElementById("button-scroll-up");

// visibility function
const btnVisibility = () => {
    if (window.scrollY > 400) {
        scrollBtn.classList.add("show");
    } else {
        scrollBtn.classList.remove("show");
    }
};

// scrollToTop function
const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}

document.addEventListener("scroll", () => {
    btnVisibility();
});

scrollBtn.addEventListener('click', event => {
    scrollToTop();
});


/*==================================================
================ Select 2 Libaray
=====================================================*/
$(document).ready(function () {

    // Select Option Service
    $("select#service").select2( {
        placeholder: "Choose Parent Service...",
    });
    // visibility
    $("select#visibility").select2( {

    });
    // Article , Category
    $("select#category").select2( {
        placeholder: "Choose Article Category...",
    });
    // Article , Pin
    $("select#pinned").select2( {
        placeholder: "Choose Article Status...",
    });
    // member , slider_show
    $("select#slider_show").select2( {
        placeholder: "Choose Slider Status...",
    });


});
/*==================================================
================ input Check
=====================================================*/
const mainChecker = document.getElementById("main-checker");
const checkItems = document.querySelectorAll(".check-item");

if (mainChecker) {

    mainChecker.addEventListener('click', event => {
        if (mainChecker.checked == true) {
            for (var i = 0; i < checkItems.length; i++) {
                checkItems[i].setAttribute("checked", "checked");
            }
        } else {
            for (var i = 0; i < checkItems.length; i++) {
                checkItems[i].removeAttribute('checked');
            }
        }
    });
}


/*==================================================
================ Danger Alert
=====================================================*/
const dangerBtns = document.querySelectorAll(".delete-record");

for (var i = 0; i < dangerBtns.length; i++) {

    const dangerBtn = dangerBtns[i];
    dangerBtn.addEventListener('click', event => {

        event.preventDefault();
        Swal.fire({

            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                );
                setTimeout(function () {
                    window.location = dangerBtn.getAttribute('href');
                }, 1000);
            }
        })

    });

}


/*==================================================
================ Multible btn Confimation
=====================================================*/
const multiAlertBtn = document.getElementById("multi-alert-btn");
const multiActionForm = document.getElementById("multi-action-form");

if (multiAlertBtn) {

    multiAlertBtn.addEventListener('click', event => {

        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to back again!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.isConfirmed) {
                multiActionForm.submit();
            }
        })

    });

}

/*==================================================
================ if Isset Multible option
=====================================================*/
const selectAction = document.getElementById('select-action');
if (selectAction) {
    selectAction.addEventListener('change', function handleChange(event) {
        multiAlertBtn.removeAttribute("disabled");
    });
}

/*========================================================================
===================  CKEditor 5   ========================================
=========================================================================*/


$(document).ready(function () {

    CKEDITOR.replaceClass = 'ckeditor';  // select by class Name

});
