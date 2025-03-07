import { List, ListItem } from '@chakra-ui/react';
import React from 'react';

interface Algorithm {
  name: string;
  id: number;
}

interface AlgorithmListProps {
  algorithms: Algorithm[];
}

const AlgorithmList: React.FC<AlgorithmListProps> = ({ algorithms }) => {
  return (
    <List.Root >
      {algorithms.map((algorithm) => (
        <List.Item listStyleType="none" pb="4" key={algorithm.id}>{algorithm.name}</List.Item>
      ))}
    </List.Root>
  );
};

export default AlgorithmList;  // Make sure you're using default export
