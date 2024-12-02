import fs from 'node:fs';
let data
try {
    data = fs.readFileSync('./data/input.txt', 'utf8');
} catch (err) {
    console.error(err);
}


function createArrayFromTxt() {
    const l = []
    data = data.split('\n')
    data.pop()

    for (let d of data) {
        const list = d.split("\n")
        for (let k of list) {
            l.push(k.split(" ").map(Number))
        }
    }
    return l
}

const reports = createArrayFromTxt()
function partOne(reports) {
    let safe = 0

    for (let report of reports) {
        let safety = false
        const isIncreasing = report[0] < report[1]
        for (const [index, level] of report.entries()) {
            const nextLevel = index === report.length - 1 ? null : report[index + 1]
            if (isIncreasing) {
                if (nextLevel > level && nextLevel - level > 0 && nextLevel - level < 4) {
                    safety = true
                } else if (index !== report.length - 1) {
                    safety = false
                    break
                }
            } else {
                if (level > nextLevel && level - nextLevel > 0 && level - nextLevel < 4) {
                    safety = true
                } else if (index !== report.length - 1) {
                    safety = false
                    break
                }
            }
        }
        if (safety) safe++

    }
    return safe
}

const result = partOne(reports)
console.log(result)
