import fs from 'node:fs';
let data
try {
  data = fs.readFileSync('./data/input.txt', 'utf8');
} catch (err) {
  console.error(err);
}

function createArrayFromTxtAndSort() {
  const list1 = []
  const list2 = []

  data = data.split('\n')

  for (let d of data) {
    const list = d.split("   ")
    
    if (list[0]) list1.push(+list[0])
    if (list[1]) list2.push(+list[1])
  }
  
  return [list1.sort(), list2.sort()]
}

const [list1, list2] = createArrayFromTxtAndSort()

function calculateTotalDistance(list1, list2) {
  let result = 0
  for (let [i, num1] of list1.entries()) {
      const num2 = list2[i]
      result += Math.abs(num2 - num1)
  }
  return result
}

console.log(calculateTotalDistance(list1, list2))
