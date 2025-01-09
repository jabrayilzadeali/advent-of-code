import fs, { access } from "node:fs"
let data
try {
    data = fs.readFileSync('./data/input.txt', 'utf8');
    // data = fs.readFileSync("./data/example.txt", "utf8")
} catch (err) {
    console.error(err)
}

function createArrayFromTxt() {
    const l = []
    data = data.split("\n")
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

function isSafe(isIncreasing, level, nextLevel) {
    if (isIncreasing) {
        if (
            nextLevel > level &&
            nextLevel - level > 0 &&
            nextLevel - level < 4
        ) {
            return true
        }
    } else {
        if (
            level > nextLevel &&
            level - nextLevel > 0 &&
            level - nextLevel < 4
        ) {
            return true
        }
    }
}

function isReportSafe(report) {
    let safety = false
    const isIncreasing = report[0] < report[1]
    for (const [index, level] of report.entries()) {
        const nextLevel = index === report.length - 1 ? null : report[index + 1]
        if (index !== report.length - 1) {
            safety = isSafe(isIncreasing, level, nextLevel)
            if (!safety) return false
        }
    }
    return true
}

const partOne = reports.reduce((sum, report) => sum += isReportSafe(report) ? 1 : 0, 0)
// console.log(partOne)

function isReportDeeplySafe(report) {
    let safe = isReportSafe(report)
    console.log(report)
    if (!safe) {
        for (const [index, _] of report.entries()) {
            const newReport = report.filter((_, i) => {
                return i !== index
            })
            safe = isReportSafe(newReport)
            if (safe) return true 
        }
    }
    return safe
}

// isReportDeeplySafe([1, 2, 3, 5, 5])
const partTwo = reports.reduce((sum, report) => sum += isReportDeeplySafe(report) ? 1 : 0, 0)
console.log(partTwo)


