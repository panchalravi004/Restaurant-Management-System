
// $(document).ready(function () {

//     // Load all section on click and load dash board as default
//     // $("#content-section").load("section/dashboard.html");
//     $("#btn-dashboard").addClass("bg-danger");
//     $("#btn-dashboard").removeClass("text-white-50");
//     $("#btn-dashboard").addClass("text-white");
    
//     $("#btn-dashboard").on("click", function () {
//         // $("#content-section").load("dashboard.blade.php");
//         $(this).addClass("bg-danger");
//         $(this).removeClass("text-white-50");
//         $(this).addClass("text-white");
//         removeClass("#btn-dashboard");
    
//     });
//     $("#btn-managetables").on("click", function () {
//         // $("#content-section").load("section/manage_table.html");
//         $(this).addClass("bg-danger");
//         $(this).removeClass("text-white-50");
//         $(this).addClass("text-white");
//         removeClass("#btn-managetables");
        
//     });
//     $("#btn-manageproduct").on("click", function () {
//         // $("#content-section").load("section/manage_product.html");
//         $(this).addClass("bg-danger");
//         $(this).removeClass("text-white-50");
//         $(this).addClass("text-white");
//         removeClass("#btn-manageproduct");
        
//     });
//     $("#btn-managecategory").on("click", function () {
//         // $("#content-section").load("section/manage_category.html");
//         $(this).addClass("bg-danger");
//         $(this).removeClass("text-white-50");
//         $(this).addClass("text-white");
//         removeClass("#btn-managecategory");
        
//     });
//     $("#btn-manageuser").on("click", function () {
//         // $("#content-section").load("section/manage_user.html");
//         $(this).addClass("bg-danger");
//         $(this).removeClass("text-white-50");
//         $(this).addClass("text-white");
//         removeClass("#btn-manageuser");
        
//     });
//     $("#btn-orderhistory").on("click", function () {
//         // $("#content-section").load("section/order_history.html");
//         $(this).addClass("bg-danger");
//         $(this).removeClass("text-white-50");
//         $(this).addClass("text-white");
//         removeClass("#btn-orderhistory");
//     });
    
//     //load section as per require ment
//     // $("#content-section").load("section/dashboard.html");
//     });
    
// function removeClass(currentElement){
//     var classList = [
//         "#btn-dashboard",
//         "#btn-managetables",
//         "#btn-manageproduct",
//         "#btn-managecategory",
//         "#btn-manageuser",
//         "#btn-orderhistory"];
//     for (let i = 0; i < classList.length; i++) {
//         if(classList[i]==currentElement){
//             continue;
//         }
//         $(classList[i]).removeClass("bg-danger");
//         $(classList[i]).removeClass("text-white");
//         $(classList[i]).addClass("text-white-50");
//     }
// }