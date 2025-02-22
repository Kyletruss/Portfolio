function weightedRandom(trueWeight, falseWeight) {
    const totalWeight = trueWeight + falseWeight;
    const randomValue = Math.random() * totalWeight;

    return randomValue < trueWeight;
}

function getRandomTimestamp(year) {
    // Start of the year
    start = new Date(year, 0, 1); // January 1st
    // End of the year
    end = new Date(year + 1, 0, 1); // January 1st of the next year

    // Generate a random timestamp between start and end
    randomTimestamp = new Date(start.getTime() + Math.random() * (end - start));

    // Format the timestamp to yyyy-mm-dd HH:mm:ss
    yyyy = randomTimestamp.getFullYear();
    mm = String(randomTimestamp.getMonth() + 1).padStart(2, '0'); // Months are 0-based
    dd = String(randomTimestamp.getDate()).padStart(2, '0');
    hh = String(randomTimestamp.getHours()).padStart(2, '0');
    min = String(randomTimestamp.getMinutes()).padStart(2, '0');
    ss = String(randomTimestamp.getSeconds()).padStart(2, '0');

    return `${yyyy}-${mm}-${dd} ${hh}:${min}:${ss}`;
}






userNames = JSON.parse('<?php echo(json_encode($names));?>');
userNumbers = JSON.parse('<?php echo(json_encode($userNumbers));?>');
otherEndNumbers = JSON.parse('<?php echo(json_encode($otherEndNumbers));?>');

console.log(userNames);
console.log(userNumbers);
console.log(otherEndNumbers);







for(i = 0; i < userNames.length; i++){
//     // logs.push(["test1", "test2", "test3"]);


    
    // for each user, generate between 1 and 20000 calls, favoring higher call counts
    // for(j = 0; j < Math.round(Math.random(1, 20000) * 20000); j++){
    for(j = 0; j < Math.floor((1 - Math.pow(Math.random(), 5)) * 20000) + 1; j++){
        // 80% chance of true
        result = weightedRandom(8, 2); 
        if(result == true){
            direction = "Outbound"
        }
        else{
            direction = "Inbound";
        }

        // creates the call record object, the duration formula is a random duration in seconds between 1 and 1800 which favors lower numbers. This is to try and replicate the usual low call duration of sales calls but still allow for longer calls.
        call = new Call(userNumbers[i], userNames[i], otherEndNumbers[Math.round(Math.random(1, 1000)* 1000)] , direction, Math.floor(Math.pow(Math.random(), 5) * 1800) + 1, getRandomTimestamp(2024));
        logs.push(call);
    }



}