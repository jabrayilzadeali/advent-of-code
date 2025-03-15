import fs from "node:fs"
let data
try {
    data = fs.readFileSync('./data/input.txt', 'utf8');
    // data = fs.readFileSync("./data/example.txt", "utf8")
} catch (err) {
    console.error(err)
}

for (const letter of data) {
    if (letter === 'm') {
        console.log(letter)
    }
}