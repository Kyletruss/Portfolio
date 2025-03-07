import React, { useMemo, useEffect, useState } from "react";
import { BarChart, Bar, XAxis, YAxis, Tooltip, ResponsiveContainer } from "recharts";

interface Algorithm {
  name: string;
  id: number;
}

interface Props {
  selectedAlgorithm: Algorithm | undefined;
}

const SortingPanel = React.memo(({ selectedAlgorithm }: Props) => {
    // Generate an array of 500 random numbers between 1 and 100 (memoize it so it doesn't regenerate on every render)
    const [data, setData] = useState(
        Array.from({ length: 500 }, (_, i) => ({ index: i, value: Math.floor(Math.random() * 100) + 1 }))
      );


    useEffect(() => {
        if (selectedAlgorithm !== null) {
          const newData = Array.from({ length: 500 }, (_, i) => ({
            index: i,
            value: Math.floor(Math.random() * 100) + 1,
          }));
          setData(newData); // Set new random data when algorithm is selected
        }
      }, [selectedAlgorithm]);

  return (
    <div>
      {selectedAlgorithm ? (
        <>
        <h2>Selected Algorithm: {selectedAlgorithm.name} (ID: {selectedAlgorithm.id})</h2>

        <ResponsiveContainer width="100%" height={400}>
            <BarChart data={data}>
            <XAxis dataKey="index" hide />
            <YAxis />
            <Tooltip />
            <Bar dataKey="value" fill="#00d8ff" isAnimationActive={false}/>
            </BarChart>
        </ResponsiveContainer>
        </>
        
      ) : (
        <h2>No Algorithm Selected</h2>
      )}


    </div>
  );
});

export default SortingPanel;
