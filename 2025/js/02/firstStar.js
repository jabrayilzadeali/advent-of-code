import fs from 'node:fs';
let data
try {
  data = fs.readFileSync('./data/input.txt', 'utf8');
} catch (err) {
  console.error(err);
}


const ranges = data.split(',').map(range => range.replace('\n', ''))
console.log(ranges)

function isValidId(num) {
  const LEN = num.toString().length
  if (LEN % 2 !== 0) return true
  const middle = LEN / 2

  const firstHalf = num.toString().slice(0, middle)
  const secondHalf = num.toString().slice(LEN - middle)
  return firstHalf !== secondHalf
}

let total = 0
const inValidIds = []
for (const range of ranges) {
  const [start, end] = range.split('-')
  for (let num = +start; num <= +end; num++) {
    if (!isValidId(num)) {
      inValidIds.push(num)
      total += num
      console.log(num, total)
    }
  }
}

console.log(inValidIds)
console.log(total)

