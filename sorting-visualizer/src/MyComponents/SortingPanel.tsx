import React, { useState, useEffect, useRef } from "react";
import { BarChart, Bar, XAxis, YAxis, Tooltip, ResponsiveContainer } from "recharts";

interface Algorithm {
  name: string;
  id: number;
}

interface Props {
  selectedAlgorithm: Algorithm | undefined;
}

const SortingPanel = React.memo(({ selectedAlgorithm }: Props) => {
  const [data, setData] = useState(
    Array.from({ length: 500 }, (_, i) => ({ index: i, value: Math.floor(Math.random() * 100) + 1 }))
  );
  const [isSorting, setIsSorting] = useState(false);
  const sortingInterval = useRef<ReturnType<typeof setInterval> | null>(null);

  const arrRef = useRef([...data]);

  useEffect(() => {
    if (!selectedAlgorithm) return;

    console.log(`Algorithm changed to: ${selectedAlgorithm.name}`);

    if (sortingInterval.current) {
      clearInterval(sortingInterval.current);
      sortingInterval.current = null;
    }

    const newData = Array.from({ length: 500 }, (_, i) => ({
      index: i,
      value: Math.floor(Math.random() * 100) + 1,
    }));
    setData(newData);
    arrRef.current = [...newData];

    setIsSorting(false);
  }, [selectedAlgorithm]);

  // Bubble Sort
  const bubbleSort = () => {
    if (isSorting) return;
    setIsSorting(true);

    let arr = [...arrRef.current];
    let i = 0, j = 0;

    sortingInterval.current = setInterval(() => {
      if (i < arr.length) {
        if (j < arr.length - i - 1) {
          if (arr[j].value > arr[j + 1].value) {
            [arr[j], arr[j + 1]] = [arr[j + 1], arr[j]];
          }
          j++;
        } else {
          j = 0;
          i++;
        }
      } else {
        clearInterval(sortingInterval.current!);
        setIsSorting(false);
      }
      setData([...arr]);
    }, 10);
  };

  // Selection Sort
  const selectionSort = () => {
    if (isSorting) return;
    setIsSorting(true);

    let arr = [...arrRef.current];
    let i = 0;

    sortingInterval.current = setInterval(() => {
      if (i < arr.length - 1) {
        let minIndex = i;
        for (let j = i + 1; j < arr.length; j++) {
          if (arr[j].value < arr[minIndex].value) minIndex = j;
        }
        if (minIndex !== i) {
          [arr[i], arr[minIndex]] = [arr[minIndex], arr[i]];
        }
        i++;
      } else {
        clearInterval(sortingInterval.current!);
        setIsSorting(false);
      }
      setData([...arr]);
    }, 10);
  };

  // Quick Sort
  const quickSort = () => {
    if (isSorting) return;
    setIsSorting(true);

    let arr = [...arrRef.current];
    let stack = [{ left: 0, right: arr.length - 1 }];

    sortingInterval.current = setInterval(() => {
      if (stack.length === 0) {
        clearInterval(sortingInterval.current!);
        setIsSorting(false);
        return;
      }

      let { left, right } = stack.pop()!;
      if (left >= right) return;

      let pivotIndex = partition(arr, left, right);
      stack.push({ left, right: pivotIndex - 1 });
      stack.push({ left: pivotIndex + 1, right });

      setData([...arr]);
    }, 10);
  };

  const partition = (arr: { index: number; value: number }[], left: number, right: number) => {
    let pivot = arr[right].value;
    let i = left;
    for (let j = left; j < right; j++) {
      if (arr[j].value < pivot) {
        [arr[i], arr[j]] = [arr[j], arr[i]];
        i++;
      }
    }
    [arr[i], arr[right]] = [arr[right], arr[i]];
    return i;
  };

  // Merge Sort
  const mergeSort = () => {
    if (isSorting) return;
    setIsSorting(true);

    let arr = [...arrRef.current];
    let step = 1;
    let sorted = false;

    sortingInterval.current = setInterval(() => {
      if (sorted) {
        clearInterval(sortingInterval.current!);
        setIsSorting(false);
        return;
      }

      let newArr = [...arr];
      for (let i = 0; i < arr.length; i += 2 * step) {
        let left = i;
        let mid = Math.min(i + step, arr.length);
        let right = Math.min(i + 2 * step, arr.length);

        merge(newArr, arr, left, mid, right);
      }

      arr = [...newArr];
      setData([...arr]);

      step *= 2;
      if (step >= arr.length) sorted = true;
    }, 50);
  };

  const merge = (
    newArr: { index: number; value: number }[],
    arr: { index: number; value: number }[],
    left: number,
    mid: number,
    right: number
  ) => {
    let i = left, j = mid, temp = [];
    while (i < mid && j < right) {
      if (arr[i].value < arr[j].value) temp.push(arr[i++]);
      else temp.push(arr[j++]);
    }
    while (i < mid) temp.push(arr[i++]);
    while (j < right) temp.push(arr[j++]);

    for (let k = left; k < right; k++) {
      newArr[k] = temp[k - left];
    }
  };

  // Handle sorting
  const handleSort = () => {
    if (!selectedAlgorithm) return;
    if (sortingInterval.current) {
      clearInterval(sortingInterval.current);
      sortingInterval.current = null;
    }

    if (selectedAlgorithm.id === 1) bubbleSort();
    else if (selectedAlgorithm.id === 2) selectionSort();
    else if (selectedAlgorithm.id === 3) quickSort();
    else if (selectedAlgorithm.id === 4) mergeSort();
  };

  return (
    <div style={{ display: "flex", flexDirection: "column", height: "100%", padding: "20px" }}>
      {selectedAlgorithm ? (
        <>
          <div style={{ display: "flex", alignItems: "center", justifyContent: "space-between", marginBottom: "10px" }}>
            <h2 style={{ margin: 0 }}>Selected Algorithm: {selectedAlgorithm.name}</h2>
            <button 
              className="btn btn-primary"
              onClick={handleSort} 
              disabled={isSorting} 
              style={{ padding: "8px 16px", fontSize: "16px", cursor: "pointer", background: "#00d8ff", borderColor: "#00d8ff" }}
            >
              {isSorting ? "Sorting..." : "Start Sorting"}
            </button>
          </div>

          <div style={{ flexGrow: 1, display: "flex", alignItems: "flex-end" }}>
            <ResponsiveContainer width="100%" height={400}>
              <BarChart data={data}>
                <XAxis dataKey="index" hide />
                <YAxis />
                <Tooltip />
                <Bar dataKey="value" fill="#00d8ff" isAnimationActive={false} />
              </BarChart>
            </ResponsiveContainer>
          </div>
        </>
      ) : (
        <h2>Please select an algorithm</h2>
      )}
    </div>
  );
});

export default SortingPanel;
