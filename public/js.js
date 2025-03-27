function containsOnlyNumbersAndHyphens(str) {
    // Regular expression to match numbers and hyphens
    const regex = /^[0-9\-]+$/;
    // Test if the string matches the regular expression
    return regex.test(str);
}


function toggleCheckedValueCustomSwitch(selector){
        if($(selector).attr('checked')===undefined){
            $(selector).attr('checked',true);
        }else{
            $(selector).attr('checked',false);


        }

}


function formatAsLink(valid_url) {
    var link = "<br><a class='text-break-all' href='" + valid_url + "' target='_blank'>" + valid_url + " </a>";

    return link;
}

function isUrlValid(string) {
    try {
        new URL(string);
        return true;
    } catch (err) {
        return false;
    }
}










