module Main where
    import Data.List.Split
    import Data.List
    
    -- Extract sign from number strings.
    sign string = take 1 string 
    -- Remove + from positiv integers.
    cleanStrInt string = if sign string == "+" then drop 1 string else string
    -- Cast cleaned number strings to integers.
    strToInt string = read string :: Integer

    main = do input <- readFile "input"
              print $ foldl (+) 0 $ map strToInt $ map cleanStrInt $ splitOn "\n" input