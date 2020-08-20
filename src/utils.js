/**
 * Return a random sample without replacement from a population.
 * @returns {[]}
 * @param {number} populationSize
 * @param {number} sampleSize
 */
export function sampleWithoutReplacement(populationSize, sampleSize)
{
    let total = 0;
    let selected = 0;
    let samples = [];
    let random = 0.0;
    while (selected < sampleSize) {
        random = Math.random(); // TODO Imperfect: [0,1), want [0,1]
        if (((populationSize - total) * random) >= (sampleSize - selected)) {
            total++;
        } else {
            samples[selected] = total + 1;
            total++;
            selected++;
        }
    }
    return samples;
}

/**
 * Return a random size sample of input array.
 * @returns {*}
 * @param {[]} array
 * @param {*} size
 */
export function getRandomSample(array, size)
{
    let shuffled = array.slice(0);
    let i = array.length;
    let temp, index;
    while (i--) {
        index = Math.floor((i + 1) * Math.random());
        temp = shuffled[index];
        shuffled[index] = shuffled[i];
        shuffled[i] = temp;
    }
    return shuffled.slice(0, size);
}

/**
 * Removes elements with value "value" from array.
 * @param input
 * @param value
 * @returns {*}
 */
function arrayRemove(input, value)
{
    return input.filter(function (ele) {
        return ele != value;
    });
}

export function randomInteger(min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

/**
 * Fetch JSON data.
 * @param url
 * @returns {Promise<void>}
 */
export function getJsonData(url)
{
    const request = async () => {
        const response = await fetch(url);
        const json = await response.json();
        console.log(json);
    }
    return request();
}
