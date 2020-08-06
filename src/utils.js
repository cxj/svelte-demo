/**
 * Return a random sample without replacement from a population.
 * @param populationSize
 * @param sampleSize
 * @returns {[]}
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

export function randomInteger(min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

/**
 * Fetch JSON data.
 * @param url
 * @returns {Promise<any>}
 */
export async function getJsonData(url)
{
    const response = await fetch(url);
    const data = await response.json();
    if (response.ok) {
        return data;
    } else {
        throw new Error(data);
    }
}
